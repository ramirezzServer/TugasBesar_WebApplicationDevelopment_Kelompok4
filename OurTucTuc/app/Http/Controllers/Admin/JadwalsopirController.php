<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalSopir;
use App\Models\Sopir;
use App\Models\Kendaraan;
use App\Models\RuteHalte;
use Illuminate\Http\Request;

class JadwalSopirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search') ?? $request->query('q');

        $query = JadwalSopir::with([
            'sopir',
            'kendaraan',
            'ruteHalte.rute',
            'ruteHalte.halte',
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('sopir', function ($sq) use ($search) {
                        $sq->where('nama_sopir', 'like', "%{$search}%")
                           ->orWhere('notelp_sopir', 'like', "%{$search}%");
                    })
                  ->orWhereHas('kendaraan', function ($kq) use ($search) {
                        $kq->where('plat_nomor', 'like', "%{$search}%");
                    })
                  ->orWhereHas('ruteHalte.rute', function ($rq) use ($search) {
                        $rq->where('nama_rute', 'like', "%{$search}%");
                    })
                  ->orWhereHas('ruteHalte.halte', function ($hq) use ($search) {
                        $hq->where('nama_halte', 'like', "%{$search}%");
                    })
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        return view('admin.jadwal-sopir.index', compact('data'));
    }

    public function create()
    {
        $sopirs = Sopir::all();
        $kendaraans = Kendaraan::all();
        $ruteHaltes = RuteHalte::with(['rute', 'halte'])->get();

        return view('admin.jadwal-sopir.create', compact('sopirs', 'kendaraans', 'ruteHaltes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kendaraan' => 'required|integer|exists:kendaraan,id',
            'id_sopir' => 'required|integer|exists:data_sopir,id',
            'id_rute_halte' => 'required|integer|exists:rute_halte,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'sometimes|in:aktif,selesai,belum_aktif',
        ]);

        JadwalSopir::create($validated);

        return redirect()->route('admin.jadwal-sopir')
            ->with('success', 'Jadwal sopir berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwalSopir = JadwalSopir::with(['sopir', 'kendaraan', 'ruteHalte'])->findOrFail($id);
        $sopirs = Sopir::all();
        $kendaraans = Kendaraan::all();
        $ruteHaltes = RuteHalte::with(['rute', 'halte'])->get();

        return view('admin.jadwal-sopir.update', compact('jadwalSopir', 'sopirs', 'kendaraans', 'ruteHaltes'));
    }

    public function update(Request $request, $id)
    {
        $jadwalSopir = JadwalSopir::findOrFail($id);

        $validated = $request->validate([
            'id_kendaraan' => 'sometimes|integer|exists:kendaraan,id',
            'id_sopir' => 'sometimes|integer|exists:data_sopir,id',
            'id_rute_halte' => 'sometimes|integer|exists:rute_halte,id',
            'jam_mulai' => 'sometimes|date_format:H:i',
            'jam_selesai' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|in:aktif,selesai,belum_aktif',
        ]);

        // Validasi jam_selesai harus setelah jam_mulai
        $jamMulai = $validated['jam_mulai'] ?? $jadwalSopir->jam_mulai;
        $jamSelesai = $validated['jam_selesai'] ?? $jadwalSopir->jam_selesai;

        if ($jamMulai && $jamSelesai && strtotime($jamSelesai) <= strtotime($jamMulai)) {
            return redirect()->back()
                ->withErrors(['jam_selesai' => 'Jam selesai harus setelah jam mulai'])
                ->withInput();
        }

        $jadwalSopir->update($validated);

        return redirect()->route('admin.jadwal-sopir')
            ->with('success', 'Jadwal sopir berhasil diupdate');
    }

    public function destroy($id)
    {
        $jadwalSopir = JadwalSopir::findOrFail($id);
        $jadwalSopir->delete();

        return redirect()->route('admin.jadwal-sopir')
            ->with('success', 'Jadwal sopir berhasil dihapus');
    }}