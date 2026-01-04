<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Kendaraan::create([
            'plat_nomor' => $request->plat_nomor,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'plat_nomor' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kendaraan->update([
            'plat_nomor' => $request->plat_nomor,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Kendaraan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->back()->with('success', 'Kendaraan berhasil dihapus!');
    }
}
