<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Halte;
use App\Http\Resources\HalteResource;

class HalteController extends Controller
{
    public function index()
    {
        $halte = Halte::with('rutes')->get();
        return response()->json([
            'success' => true,
            'data' => HalteResource::collection($halte)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_halte' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Silahkan periksa permintaan anda',
                'errors' => $validator->errors()
            ], 422);
        }

        $halte = Halte::create($validator->validated());

        return (new HalteResource($halte))
            ->additional(['message' => 'Halte berhasil dibuat'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $halte = Halte::find($id);

        if (!$halte) {
            return response()->json([
                'message' => 'Halte tidak ditemukan'
            ], 404);
        }

        return new HalteResource($halte);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
           'nama_halte' => 'sometimes|required|string|max:255' 
        ]);

    $halte = Halte::find($id);
    
    if (!$halte) {
        return response()->json(['message' => 'Halte tidak ditemukan'], 404);
    }
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Silahkan periksa permintaan anda',
            'errors' => $validator->errors()
            ], 422);
    }
    $halte->update($validator->validated());

    return(new HalteResource($halte))
            ->additional(['message' => 'Halte berhasil diupdate'])
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(string $id)
    {
        $halte = Halte::find($id);

        if (!$halte){
            return response()->json([
                'success' => false,
                'message' => 'Halte tidak ditemukan'
            ], 404);
        }

        $halte->delete();

        return response()->json(['message' => 'Halte berhasil dihapus'
        ], 200);
    }
}
