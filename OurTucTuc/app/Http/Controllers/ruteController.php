<?php

namespace App\Http\Controllers;

use App\Http\Resources\ruteResource;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ruteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rute = Rute::all();
        return ruteResource::collection($rute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rute' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([

                'success' => false,
                'message' => 'cek ulang requestmu',
                'error' => $validator->errors()
            ], 422);
        }

        $rute = Rute::create($validator->validated());

        return (new ruteResource($rute))
            ->additional(['message' => 'rute berhasil ditambahkan'])
            ->response()
            ->setStatusCode(201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $rute = Rute::find($id);
        if (!$rute) {
            return response()->json([
                'success' => false,
                 'message' => 'rute tidak ada'
            ], 404);
    }
            return new ruteResource($rute);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_rute' => 'required|string|max:255'
        ]);

        $rute = Rute::find($id);
        if (!$rute) {
            return response()->json([
                 'success' => false,
                 'message' => 'rute yang kamu cari tidak ada'
            ], 404);
        }

        if ($validator->fails()) {
            return response()->json([
                 'success' => false,
                 'errors' => "cek lagi requestmu"
            ], 422);
        }

        $rute->update($validator->validated());

        return (new ruteResource($rute))
            ->additional(['message' => 'rute berhasil diupdate'])
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
          $rute = Rute::find($id);

        if (!$rute) {
            return response()->json([
                 'success' => false,
                 'message' => 'rute tidak ditemukan'
            ], 404);
        }

          $rute->delete();

        return response()->json([
            'message' => 'rute berhasil dihapus'
        ], 200);
    }
}
