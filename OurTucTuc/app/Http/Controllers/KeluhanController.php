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
        $query = Keluhan::query()->with('penumpang:id,name,email,NoTelp');

        if ($request->filled('status')) {
            $request->validate([
                'status' => ['required', Rule::in(['diajukan', 'diselesaikan'])],
            ]);
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
        $userId = Auth::id();

        $rules = [
            'nama_keluhan' => ['required', 'string', 'max:255'],
        ];

        if (!$userId) {
            $rules['id_penumpang'] = ['required', 'integer', 'exists:users,id'];
        }

        $data = $request->validate($rules);

        $keluhan = Keluhan::create([
            'nama_keluhan' => $data['nama_keluhan'],
            'status'       => 'diajukan',
            'id_penumpang' => $userId ?? $data['id_penumpang'],
        ]);

        $keluhan->load('penumpang:id,name,email,NoTelp');

        return (new KeluhanResource($keluhan))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $keluhan = Keluhan::with('penumpang:id,name,email,NoTelp')->findOrFail($id);
        return new KeluhanResource($keluhan);
    }

    public function update(Request $request, string $id)
    {
        $keluhan = Keluhan::findOrFail($id);

        $data = $request->validate([
            'nama_keluhan' => ['sometimes', 'string', 'max:255'],
            'status'       => ['sometimes', Rule::in(['diajukan', 'diselesaikan'])],
        ]);

        $keluhan->update($data);
        $keluhan->load('penumpang:id,name,email,NoTelp');

        return new KeluhanResource($keluhan);
    }

    public function destroy(string $id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus.'
        ], 200);
    }
}
