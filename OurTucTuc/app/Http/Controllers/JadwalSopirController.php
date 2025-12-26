<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\JadwalSopir;
use App\Http\Resources\JadwalSopirResource;

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
          'nama_sopir' => 'required|string|max:255', 
          'jam_mulai' => 'required|date_format:H:i',
          'jam_selesai' => 'required|date_format:H:i',
          'status' => 'required|in:aktif,selesai,belum_aktif',
          'id_rute_halte' => 'required|integer',
          'id_sopir' => 'required|integer',
          'nama_rute' => 'required|string|max:255',
          'jam_berangkat' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json([

                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $jadwalSopir = JadwalSopir::create($validator->validated());

        return (new JadwalSopirResource($jadwalSopir))
        ->additional(['message' => 'Jadwal sopir created succsessfully'])
        ->response()
        ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $jadwalSopir = JadwalSopir::find($id);
        if (!$jadwalSopir) {
            return response()->json([

                'message' => 'Jadwal sopir not found'
            ], 404);
        }


        return new JadwalSopirResource($jadwalSopir);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
          'nama_sopir' => 'required|string|max:255', 
          'jam_mulai' => 'required|date_format:H:i',
          'jam_selesai' => 'required|date_format:H:i',
          'status' => 'required|in:aktif,selesai,belum_aktif',
          'id_rute_halte' => 'required|integer',
          'id_sopir' => 'rquired|integer',
          'nama_rute' => 'required|string|max:255',
          'jam_berangkat' => 'required|date_format:H:i',
        ]);

        $jadwalSopir = JadwalSopir::find($id);

        if (!$jadwalSopir) {
            return response()->json([
      
            ], 404);
        }


        if ($validator->fails()) {
            return response()->json([

                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $jadwalSopir->update($validator->validated());

        return (new JadwalSopirResource($jadwalSopir))
        ->additional(['message' => 'Jadwal sopir updated succsessfully'])
        ->response()
        ->setStatusCode(201);
    }

    public function destroy(string $id)
    {
        $jadwalSopir = JadwalSopir::find($id);

        if (!$jadwalSopir) {
            return response()->json([
                'message' => 'Jadwal sopir not found'
            ], 404);
        }
        $jadwalSopir->delete();

        return response()->json(['message' => "Jadwal sopir deleted successfully"], 200);
    }
}


