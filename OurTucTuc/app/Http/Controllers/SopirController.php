<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sopir;
use App\Http\Resources\SopirResource;

class SopirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sopir = Sopir::all();
        return SopirResource::collection($sopir);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sopir' => 'required|string|max:255',
            'notelp_sopir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255|unique:users,email',
            'email_sopir' => 'required|string|max:255',
            'foto' => 'required|string',
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $sopir = Sopir::create($validator->validated());

        return (new SopirResource($sopir))
            ->additional(['message' => 'Sopir created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sopir = Sopir::find($id);
        if (!$sopir) {
            return response()->json(['message' => 'Sopir not found'], 404);
        }
        return new SopirResource($sopir);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_sopir' => 'required|string|max:255',
            'notelp_sopir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255|unique:users,email',
            'email_sopir' => 'required|string|max:255',
            'foto' => 'required|string',
        ]); 

        $sopir = Sopir::find($id);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $sopir->update($validator->validated());

        return (new SopirResource($sopir))
            ->additional(['message' => 'Sopir updated successfully'])
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $sopir = Sopir::find($id);

         if (!$sopir) {
            return response()->json(['message' => 'Sopir not found'], 404);
         }

         $sopir->delete();

         return response()->json(['message' => 'Sopir deleted successfully'], 200);

    }
}
