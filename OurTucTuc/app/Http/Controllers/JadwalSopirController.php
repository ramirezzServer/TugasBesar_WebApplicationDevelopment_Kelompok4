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
        $jadwalSopirs = JadwalSopir::all();
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
                'errors' => $validator->errors(),
            ], 422);
        }

        $jadwalSopir = JadwalSopir::create($validator->validated());

        return (new JadwalSopirResource($jadwalSopir))
            ->additional(['message' => 'Jadwal sopir created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $jadwalSopir = JadwalSopir::find($id);

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

        // Biar fleksibel, update boleh parsial (kadang cuma status doang, misalnya)
        $validator = Validator::make($request->all(), [
            'id_kendaraan'   => 'sometimes|required|integer|exists:kendaraan,id',
            'id_sopir'       => 'sometimes|required|integer|exists:data_sopir,id',
            'id_rute_halte'  => 'sometimes|required|integer|exists:rute_halte,id',
            'jam_mulai'      => 'sometimes|required|date_format:H:i',
            'jam_selesai'    => 'sometimes|required|date_format:H:i',
            'status'         => 'sometimes|required|in:aktif,selesai,belum_aktif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Kalau jam_mulai & jam_selesai sama-sama dikirim, validasi urutan jam
        $data = $validator->validated();
        if (isset($data['jam_mulai'], $data['jam_selesai'])) {
            if (strtotime($data['jam_selesai']) <= strtotime($data['jam_mulai'])) {
                return response()->json([
                    'message' => 'Please check your request',
                    'errors' => ['jam_selesai' => ['jam_selesai must be after jam_mulai']],
                ], 422);
            }
        }

        $jadwalSopir->update($data);

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
