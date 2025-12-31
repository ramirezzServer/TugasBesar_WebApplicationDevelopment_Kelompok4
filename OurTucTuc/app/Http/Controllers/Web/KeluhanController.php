<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluhan;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    /**
     * Tampilkan daftar keluhan user
     */
    public function index(Request $request)
    {
        $keluhans = Keluhan::where('id_penumpang', Auth::id())
            ->when($request->q, function ($query) use ($request) {
                $query->where('nama_keluhan', 'like', '%' . $request->q . '%');
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);

        return view('user.keluhan.index', compact('keluhans'));
    }

    /**
     * Simpan keluhan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_keluhan' => 'required|string|max:255',
        ]);

        Keluhan::create([
            'id_penumpang' => Auth::id(),
            'nama_keluhan' => $request->nama_keluhan,
            'status'       => 'diajukan',
        ]);

        return redirect()
            ->route('user.keluhan')
            ->with('success', 'Keluhan berhasil dikirim');
    }

    /**
     * Form edit keluhan
     */
    public function edit($id)
    {
        $keluhan = Keluhan::where('id', $id)
            ->where('id_penumpang', Auth::id())
            ->firstOrFail();

        return view('user.keluhan.edit', compact('keluhan'));
    }

    /**
     * Update keluhan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_keluhan' => 'required|string|max:255',
        ]);

        $keluhan = Keluhan::where('id', $id)
            ->where('id_penumpang', Auth::id())
            ->firstOrFail();

        $keluhan->update([
            'nama_keluhan' => $request->nama_keluhan,
            'status'       => 'diajukan',
        ]);

        return redirect()
            ->route('user.keluhan')
            ->with('success', 'Keluhan berhasil diperbarui dan diajukan kembali');
    }

    /**
     * Hapus keluhan
     */
    public function destroy($id)
    {
        $keluhan = Keluhan::where('id', $id)
            ->where('id_penumpang', Auth::id())
            ->firstOrFail();

        $keluhan->delete();

        return redirect()
            ->route('user.keluhan')
            ->with('success', 'Keluhan berhasil dihapus');
    }
}
