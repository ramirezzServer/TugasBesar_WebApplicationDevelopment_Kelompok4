<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * GET /api/users
     * List semua user (biasanya buat admin).
     * Optional query:
     * - q=keyword (search name/email)
     * - per_page=10
     */
    public function index(Request $request)
    {
        $query = User::query()->select('id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($request->boolean('with_keluhan')) {
        $query->with(['keluhans:id,id_penumpang,nama_keluhan,status,created_at']);
        }

        if ($request->boolean('with_keluhan_count')) {
            $query->withCount('keluhans');
        }

        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min($perPage, 100));

        return response()->json(
            $query->latest()->paginate($perPage)
        );
    }

    /**
     * GET /api/users/{id}
     * Detail user by id
     */
    public function show(string $id)
    {
        $user = User::select('id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at')
            ->findOrFail($id);

        return response()->json($user);
    }

    /**
     * GET /api/me
     * Profile user yang lagi login
     */
    public function me(Request $request)
    {
        return response()->json(
            $request->user()
        );
    }

    /**
     * PUT/PATCH /api/me
     * Update profile user login
     * Body (optional):
     * - name
     * - email (unique)
     * - NoTelp
     * - password (kalau mau ganti)
     */
    public function updateMe(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'   => ['sometimes', 'string', 'max:255'],
            'email'  => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'NoTelp' => ['sometimes', 'string'],
            'password' => ['sometimes', 'string', 'min:6'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile berhasil diupdate.',
            'data' => $user->only(['id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at']),
        ]);
    }

    /**
     * PUT/PATCH /api/users/{id}
     * Update user by id (buat admin / operator).
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'   => ['sometimes', 'string', 'max:255'],
            'email'  => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'NoTelp' => ['sometimes', 'string'],
            'password' => ['sometimes', 'string', 'min:6'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User berhasil diupdate.',
            'data' => $user->only(['id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at']),
        ]);
    }

    /**
     * DELETE /api/users/{id}
     * Hapus user by id
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // biar aman: user yang lagi login jangan bisa hapus dirinya sendiri
        if (Auth::check() && (int) $user->id === (int) Auth::id()) {
            return response()->json([
                'message' => 'Tidak bisa menghapus akun yang sedang login.'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus.'
        ], 200);
    }
}
