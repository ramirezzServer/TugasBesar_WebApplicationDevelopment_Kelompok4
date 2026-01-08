<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JadwalSopir;
use App\Models\Kendaraan;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserDashboardController extends Controller
{
    public function index()
    {
       $rutes = Rute::with([
        'rute_halte.halte',
        'rute_halte.jadwalSopir.kendaraan',
        'rute_halte.jadwalSopir.sopir'
    ])->get();

   $now = date('H:i');

foreach ($rutes as $rute) {
    foreach ($rute->rute_halte as $rh) {
        foreach ($rh->jadwalSopir as $jadwal) {

            if ($now < $jadwal->jam_mulai) {
                $jadwal->status_auto = 'Belum Aktif';
            }
            elseif ($now >= $jadwal->jam_mulai && $now <= $jadwal->jam_selesai) {
                $jadwal->status_auto = 'Aktif';
            }
            else {
                $jadwal->status_auto = 'Selesai';
            }

        }
    }
}

        return view('user.dashboard.index', compact('rutes'));
    }

    /**
     * Realtime endpoint (polling) untuk dashboard user.
     * Matching DB:
     * - kendaraan: id, plat_nomor, status(aktif|nonaktif)
     * - jadwal_sopir: jam_mulai, jam_selesai, status(aktif|selesai|belum_aktif), id_kendaraan, id_sopir, id_rute_halte
     * - rute_halte: jam_berangkat, id_rute, id_halte -> rute.nama_rute, halte.nama_halte
     */
    public function data(Request $request)
    {
        $now = Carbon::now();

        $kendaraans = Kendaraan::orderBy('id', 'asc')->get();
        $kendaraanIds = $kendaraans->pluck('id')->all();

        // Ambil jadwal terbaru per kendaraan (by updated_at)
        $jadwals = JadwalSopir::with([
                'sopir',
                'kendaraan',
                'ruteHalte.rute',
                'ruteHalte.halte',
            ])
            ->whereIn('id_kendaraan', $kendaraanIds)
            ->orderByDesc('updated_at')
            ->get()
            ->groupBy('id_kendaraan')
            ->map(fn($g) => $g->first()); // latest per kendaraan

        $vehicles = [];
        $activeCount = 0;
        $transitCount = 0;
        $inactiveCount = 0;

        foreach ($kendaraans as $k) {
            $jadwal = $jadwals->get($k->id);

            // Status UI: active / transit / inactive
            $uiStatus = 'inactive';

            if ($k->status === 'nonaktif') {
                $uiStatus = 'inactive';
            } else {
                if ($jadwal) {
                    if ($jadwal->status === 'aktif') $uiStatus = 'active';
                    elseif ($jadwal->status === 'belum_aktif') $uiStatus = 'transit';
                    else $uiStatus = 'inactive'; // selesai
                } else {
                    $uiStatus = 'inactive';
                }
            }

            if ($uiStatus === 'active') $activeCount++;
            elseif ($uiStatus === 'transit') $transitCount++;
            else $inactiveCount++;

            $ruteName  = $jadwal?->ruteHalte?->rute?->nama_rute;
            $halteName = $jadwal?->ruteHalte?->halte?->nama_halte;

            // ETA:
            // - active: hitung sisa waktu ke jam_selesai
            // - transit (belum_aktif): hitung waktu menuju jam_mulai
            $eta = '—';

            if ($jadwal && $uiStatus !== 'inactive') {
                $target = null;

                if ($uiStatus === 'active' && $jadwal->jam_selesai) {
                    $target = Carbon::createFromTimeString($jadwal->jam_selesai);
                } elseif ($uiStatus === 'transit' && $jadwal->jam_mulai) {
                    $target = Carbon::createFromTimeString($jadwal->jam_mulai);
                }

                if ($target) {
                    // Anggap jadwal hari ini; kalau target sudah lewat, tampilkan "—"
                    $diffMin = $now->diffInMinutes($target, false);
                    if ($diffMin > 0) {
                        if ($diffMin < 60) $eta = $diffMin . " menit";
                        else {
                            $h = intdiv($diffMin, 60);
                            $m = $diffMin % 60;
                            $eta = $h . " jam" . ($m ? " {$m} menit" : "");
                        }
                    }
                }
            }

            $vehicles[] = [
                'id' => (string) $k->id,
                'name' => 'TUC-TUC ' . $k->plat_nomor,
                'plat_nomor' => $k->plat_nomor,

                'route' => $ruteName ? ($ruteName . ($halteName ? " • {$halteName}" : "")) : 'Belum ada jadwal',

                'status' => $uiStatus, // active|transit|inactive

                'driver' => $jadwal?->sopir?->nama_sopir ?? '-',
                'location' => $halteName ?? '-',
                'halte_id' => $jadwal?->ruteHalte?->id_halte ?? null,
                'rute_id' => $jadwal?->ruteHalte?->id_rute ?? null,

                'jam_mulai' => $jadwal?->jam_mulai,
                'jam_selesai' => $jadwal?->jam_selesai,
                'jam_berangkat' => $jadwal?->ruteHalte?->jam_berangkat,

                'eta' => $eta,
                'last_update' => $jadwal?->updated_at?->diffForHumans() ?? $k->updated_at?->diffForHumans(),
            ];
        }

        return response()->json([
            'server_time' => $now->toIso8601String(),
            'counts' => [
                'active' => $activeCount,
                'transit' => $transitCount,
                'inactive' => $inactiveCount,
            ],
            'vehicles' => $vehicles,
        ]);
    }
}
