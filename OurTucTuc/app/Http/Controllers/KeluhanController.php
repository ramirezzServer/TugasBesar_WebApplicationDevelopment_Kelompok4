<?php

namespace App\Http\Controllers;

use App\Http\Resources\KeluhanResource;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Keluhan::with('penumpang:id,name');

        if ($user->role === 'penumpang') {

            $query->where('id_penumpang', $user->id);
        }

        $keluhan = $query->latest()->get();

        return KeluhanResource::collection($keluhan);
    }

    // Fungsi baru untuk search
    public function search(Request $request)
    {
        $request->validate([
            'q'      => ['required', 'string'],
            'status' => ['nullable', Rule::in(['diajukan', 'diselesaikan'])],
            'mine'   => ['nullable', 'boolean'],
        ]);

        $query = Keluhan::query()->with('penumpang:id,name');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->where('nama_keluhan', 'like', '%' . $request->q . '%');
        }

        if ($request->boolean('mine') && Auth::check()) {
            $query->where('id_penumpang', Auth::id());
        }

        $keluhan = $query->latest()->get();

        return KeluhanResource::collection($keluhan);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama_keluhan' => ['required', 'string', 'max:255'],
        ]);

        $keluhan = Keluhan::create([
            'nama_keluhan' => $data['nama_keluhan'],
            'status'       => 'diajukan',
            'id_penumpang' => $user->id,
        ]);

        $keluhan->load('penumpang:id,name');

        return (new KeluhanResource($keluhan))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $keluhan = Keluhan::with('penumpang:id,name')->findOrFail($id);
        return new KeluhanResource($keluhan);
    }



    public function update(Request $request, string $id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'penumpang' && $keluhan->id_penumpang !== $user->id) {
            return response()->json(['message' => 'Tidak punya akses.'], 403);
        }

        $data = $request->validate([
            'nama_keluhan' => ['sometimes', 'string', 'max:255'],
            'status'       => ['sometimes', Rule::in(['diajukan', 'diselesaikan'])],
        ]);

        if ($user->role === 'penumpang') {
            unset($data['status']);
        }

        $keluhan->update($data);
        $keluhan->load('penumpang:id,name');

        return new KeluhanResource($keluhan);
    }



    public function destroy(string $id)
    {
        $user = Auth::user();
        $keluhan = Keluhan::findOrFail($id);
        if ($user->role === 'admin') {
            return response()->json(['message' => 'Admin tidak diperbolehkan menghapus keluhan.'], 403);
        }

        if ($user->role === 'penumpang' && $keluhan->id_penumpang !== $user->id) {
            return response()->json(['message' => 'Tidak punya akses.'], 403);
        }

        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus.'
        ], 200);
    }
}
