<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sopir; 
use Illuminate\Support\Facades\Storage;

class SopirController extends Controller
{
   
    public function index()
    {
        $sopir = Sopir::all();
        return view('admin.sopir.index', compact('sopir'));
    }

    
    public function create()
    {
        return view('admin.sopir.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama_sopir'   => 'required|string|max:255',
            'notelp_sopir' => 'required|string|max:15',
            'alamat'       => 'required|string',
            'email_sopir'  => 'required|email|unique:data_sopir,email_sopir',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        Sopir::create($data);

        return redirect()->route('admin.sopir.index')->with('success', 'Sopir berhasil ditambahkan');
    }


    public function edit($id)
    {
        $sopir = Sopir::findOrFail($id);
        return view('admin.sopir.edit', compact('sopir'));
    }

  
    public function update(Request $request, $id)
    {
        $sopir = Sopir::findOrFail($id);

        $request->validate([
            'nama_sopir'   => 'required|string|max:255',
            'notelp_sopir' => 'required|string|max:15',
            'alamat'       => 'required|string',
            'email_sopir'  => 'required|email|unique:data_sopir,email_sopir,' . $id,
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {
            if ($sopir->foto && Storage::disk('public')->exists($sopir->foto)) {
                Storage::disk('public')->delete($sopir->foto);
            }
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        $sopir->update($data);

        return redirect()->route('admin.sopir.index')->with('success', 'Data sopir berhasil diupdate');
    }

    public function destroy($id)
    {
        $sopir = Sopir::findOrFail($id);
        
        if ($sopir->foto && Storage::disk('public')->exists($sopir->foto)) {
            Storage::disk('public')->delete($sopir->foto);
        }

        $sopir->delete();

        return redirect()->route('admin.sopir.index')->with('success', 'Sopir berhasil dihapus');
    }
}