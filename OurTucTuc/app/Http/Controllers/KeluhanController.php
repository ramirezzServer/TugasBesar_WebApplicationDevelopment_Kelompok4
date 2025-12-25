<?php

namespace App\Http\Controllers;

use App\Http\Resources\KeluhanResource;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KeluhanController extends Controller
{
    /**
     * GET /keluhan
     * Optional query:
     * - status=diajukan|diselesaikan
     * - q=keyword
     * - mine=true (keluhan milik user login)
     * - per_page=10
     */
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

        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min($perPage, 100));

        $keluhan = $query->latest()->paginate($perPage);

        return KeluhanResource::collection($keluhan);
    }

    /**
     * POST /keluhan
     * Body:
     * - nama_keluhan (required)
     * - id_penumpang (required kalau tidak pakai auth)
     */
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

    /**
     * GET /keluhan/{id}
     */
    public function show(string $id)
    {
        $keluhan = Keluhan::with('penumpang:id,name,email,NoTelp')->findOrFail($id);

        // Optional proteksi: cuma pemilik yang boleh lihat
        // if (Auth::check() && $keluhan->id_penumpang !== Auth::id()) {
        //     abort(403, 'Tidak punya akses.');
        // }

        return new KeluhanResource($keluhan);
    }

    /**
     * PUT/PATCH /keluhan/{id}
     * Body (optional):
     * - nama_keluhan
     * - status=diajukan|diselesaikan
     */
    public function update(Request $request, string $id)
    {
        $keluhan = Keluhan::findOrFail($id);

        // Optional proteksi
        // if (Auth::check() && $keluhan->id_penumpang !== Auth::id()) {
        //     abort(403, 'Tidak punya akses.');
        // }

        $data = $request->validate([
            'nama_keluhan' => ['sometimes', 'string', 'max:255'],
            'status'       => ['sometimes', Rule::in(['diajukan', 'diselesaikan'])],
        ]);

        $keluhan->update($data);
        $keluhan->load('penumpang:id,name,email,NoTelp');

        return new KeluhanResource($keluhan);
    }

    /**
     * DELETE /keluhan/{id}
     */
    public function destroy(string $id)
    {
        $keluhan = Keluhan::findOrFail($id);

        // Optional proteksi
        // if (Auth::check() && $keluhan->id_penumpang !== Auth::id()) {
        //     abort(403, 'Tidak punya akses.');
        // }

        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus.'
        ], 200);
    }
}
