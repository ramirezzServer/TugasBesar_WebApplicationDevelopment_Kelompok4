<?php

namespace App\Http\Controllers;
use App\Models\Kendaraan;
use App\Http\Resources\KendaraanResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return KendaraanResource::collection($kendaraans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plat_nomor' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response() -> json([
                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $kendaraan = Kendaraan::create($validator->validated());
        return (new KendaraanResource($kendaraan))
            ->additional(['message' => 'Kendaraan berhasil dibuat'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show (string $id)
    {
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return response()->json(['message' => 'Kendaraan Tidak Ditemukan'], 404);
        }
        return new KendaraanResource($kendaraan);
    }

    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'message' => 'Kendaraan Tidak Ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'plat_nomor' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:aktif,nonaktif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kendaraan->update($validator->validated());

        return (new KendaraanResource($kendaraan))
            ->additional(['message' => 'Kendaraan berhasil diupdate'])
            ->response()
            ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'message' => 'Kendaraan Tidak Ditemukan'
            ], 404);
        }

        $kendaraan->delete();

        return response()->json([
            'message' => 'Kendaraan berhasil dihapus'
        ], 200);
    }
}