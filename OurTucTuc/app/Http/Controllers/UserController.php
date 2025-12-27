<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Hanya menampilkan user + relasi keluhan
    public function index(Request $request)
    {
        $query = User::query()->select('id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at');

        if ($request->boolean('with_keluhan_count')) {
            $query->withCount('keluhans');
        }

        $users = $query->latest()->get();

        return UserResource::collection($users);
    }

    // Fungsi baru khusus search
    public function search(Request $request)
    {
        $request->validate([
            'q' => ['required', 'string']
        ]);

        $q = $request->q;

        $query = User::query()->select('id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at')
            ->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });

        if ($request->boolean('with_keluhan_count')) {
            $query->withCount('keluhans');
        }

        $users = $query->latest()->get();

        return UserResource::collection($users);
    }

    public function show(string $id)
    {
        $user = User::select('id', 'name', 'email', 'NoTelp', 'created_at', 'updated_at')
            ->with(['keluhans:id,id_penumpang,nama_keluhan,status,created_at'])
            ->findOrFail($id);

        return new UserResource($user);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $user->load(['keluhans:id,id_penumpang,nama_keluhan,status,created_at']);

        return new UserResource($user);
    }

    public function updateMe(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'   => ['sometimes', 'string', 'max:255'],
            'email'  => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'NoTelp' => ['sometimes', 'string'],
            'password' => ['sometimes','string', 'min:8', 'confirmed'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile berhasil diupdate.',
            'data' => new UserResource($user->fresh()),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'   => ['sometimes', 'string', 'max:255'],
            'email'  => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'NoTelp' => ['sometimes', 'string'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User berhasil diupdate.',
            'data' => new UserResource($user->fresh()),
        ]);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

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
