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
     * - status=baru|diajukan|diselesaikan
     * - q=keyword (search nama_keluhan)
     * - mine=true (keluhan milik user login)
     * - per_page=10
     */
    public function index(Request $request)
    {
        $query = Keluhan::query()->with('penumpang:id,name,email,NoTelp');

        if ($request->filled('status')) {
            $request->validate([
                'status' => ['required', Rule::in(['baru', 'diajukan', 'diselesaikan'])],
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
     * - status (optional) default: baru
     * - id_penumpang (required kalau tidak pakai auth)
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'nama_keluhan' => ['required', 'string', 'max:255'],
            'status'       => ['sometimes', Rule::in(['baru', 'diajukan', 'diselesaikan'])],
        ];

        if (!$userId) {
            $rules['id_penumpang'] = ['required', 'integer', 'exists:users,id'];
        }

        $data = $request->validate($rules);

        $keluhan = Keluhan::create([
            'nama_keluhan' => $data['nama_keluhan'],
            'status'       => $data['status'] ?? 'baru',
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

    /**
     * PUT/PATCH /keluhan/{id}
     * Body (optional):
     * - nama_keluhan
     * - status
     */
    public function update(Request $request, string $id)
    {
        $keluhan = Keluhan::findOrFail($id);

        $data = $request->validate([
            'nama_keluhan' => ['sometimes', 'string', 'max:255'],
            'status'       => ['sometimes', Rule::in(['baru', 'diajukan', 'diselesaikan'])],
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
