<?php

namespace App\Http\Controllers\Admin;
use App\Models\RuteHalte;
use App\Http\Controllers\Controller;

class RuteHalteController extends Controller
{
    public function index()
    {
        $ruteHalte = RuteHalte::with(['rute', 'halte'])->get();
        return view('admin.rute-halte.index', compact('ruteHalte'));
    }

    public function destroy($id)
    {
        $ruteHalte = RuteHalte::findOrFail($id);
        $ruteHalte->delete();

        return redirect()->route('admin.rute-halte.index')
            ->with('success', 'Data Rute-Halte berhasil dihapus!');
    }

}
