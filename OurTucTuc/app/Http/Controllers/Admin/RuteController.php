<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index()
    {
        $data = Rute::all();
        return view('admin.rute.index', compact('data'));
    }

    public function create()
    {
        return view('admin.rute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rute' => 'required|string|max:255'
        ]);

        Rute::create([
            'nama_rute' => $request->nama_rute
        ]);

        return redirect()->route('admin.rute.index')
            ->with('success', 'Rute berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rute = Rute::findOrFail($id);
        return view('admin.rute.edit', compact('rute'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rute' => 'required|string|max:255'
        ]);

        $rute = Rute::findOrFail($id);
        $rute->update([
            'nama_rute' => $request->nama_rute
        ]);

        return redirect()->route('admin.rute.index')
            ->with('success', 'Rute berhasil diupdate');
    }

    public function destroy($id)
    {
        $rute = Rute::findOrFail($id);
        $rute->delete();

        return redirect()->route('admin.rute.index')
            ->with('success', 'Rute berhasil dihapus');
    }
}
