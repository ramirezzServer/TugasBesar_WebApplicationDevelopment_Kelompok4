<?php

namespace App\Http\Controllers;

use App\Models\JadwalSopir;
use App\Http\Resources\JadwalSopirResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalSopirController extends Controller
{
    public function index()
    {
        $jadwalSopirs = JadwalSopir::with(['sopir', 'kendaraan', 'ruteHalte'])->get();
        return JadwalSopirResource::collection($jadwalSopirs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kendaraan'   => 'required|integer|exists:kendaraan,id',
            'id_sopir'       => 'required|integer|exists:data_sopir,id',
            'id_rute_halte'  => 'required|integer|exists:rute_halte,id',
            'jam_mulai'      => 'required|date_format:H:i',
            'jam_selesai'    => 'required|date_format:H:i|after:jam_mulai',
            'status'         => 'required|in:aktif,selesai,belum_aktif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $jadwalSopir = JadwalSopir::create($validator->validated());
        $jadwalSopir->load(['sopir', 'kendaraan', 'ruteHalte']);

        return (new JadwalSopirResource($jadwalSopir))
            ->additional(['message' => 'Jadwal sopir created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $jadwalSopir = JadwalSopir::with(['sopir', 'kendaraan', 'ruteHalte'])->find($id);

        if (!$jadwalSopir) {
            return response()->json([
                'message' => 'Jadwal sopir not found',
            ], 404);
        }

        return new JadwalSopirResource($jadwalSopir);
    }

    public function update(Request $request, string $id)
    {
        $jadwalSopir = JadwalSopir::find($id);

        if (!$jadwalSopir) {
            return response()->json([
                'message' => 'Jadwal sopir not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_kendaraan'   => 'sometimes|integer|exists:kendaraan,id',
            'id_sopir'       => 'sometimes|integer|exists:data_sopir,id',
            'id_rute_halte'  => 'sometimes|integer|exists:rute_halte,id',
            'jam_mulai'      => 'sometimes|date_format:H:i',
            'jam_selesai'    => 'sometimes|date_format:H:i',
            'status'         => 'sometimes|in:aktif,selesai,belum_aktif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Validasi jam_selesai harus setelah jam_mulai
        // (baik saat update salah satu field, ataupun dua-duanya)
        $jamMulai = $data['jam_mulai'] ?? $jadwalSopir->jam_mulai;
        $jamSelesai = $data['jam_selesai'] ?? $jadwalSopir->jam_selesai;

        if ($jamMulai && $jamSelesai) {
            if (strtotime($jamSelesai) <= strtotime($jamMulai)) {
                return response()->json([
                    'message' => 'Please check your request',
                    'errors'  => [
                        'jam_selesai' => ['jam_selesai must be after jam_mulai'],
                    ],
                ], 422);
            }
        }

        $jadwalSopir->update($data);
        $jadwalSopir->load(['sopir', 'kendaraan', 'ruteHalte']);

        return (new JadwalSopirResource($jadwalSopir))
            ->additional(['message' => 'Jadwal sopir updated successfully'])
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(string $id)
    {
        $jadwalSopir = JadwalSopir::find($id);

        if (!$jadwalSopir) {
            return response()->json([
                'message' => 'Jadwal sopir not found',
            ], 404);
        }

        $jadwalSopir->delete();

        return response()->json([
            'message' => 'Jadwal sopir deleted successfully',
        ], 200);
    }
}
