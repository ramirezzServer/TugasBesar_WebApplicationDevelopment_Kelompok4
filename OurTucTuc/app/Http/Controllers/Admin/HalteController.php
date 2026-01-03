<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halte;
use Illuminate\Http\Request;

class HalteController extends Controller
{
    public function index()
    {
        $halte = Halte::all();
        return view('admin.halte.index', compact('halte'));
    }

    public function create()
    {
        return view('admin.halte.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_halte' => 'required|string|max:255',
        ]);

        Halte::create([
            'nama_halte' => $request->nama_halte,
        ]);

        return redirect()->route('admin.halte.index')
            ->with('success', 'Data Halte berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $halte = Halte::findOrFail($id);
        return view('admin.halte.edit', compact('halte'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_halte' => 'required|string|max:255',
        ]);

        $halte = Halte::findOrFail($id);
        $halte->update([
            'nama_halte' => $request->nama_halte,
        ]);

        return redirect()->route('admin.halte.index')
            ->with('success', 'Data Halte berhasil diupdate!');
    }

    public function destroy($id)
    {
        $halte = Halte::findOrFail($id);
        $halte->delete();

        return redirect()->route('admin.halte.index')
            ->with('success', 'Data Halte berhasil dihapus!');
    }
}
