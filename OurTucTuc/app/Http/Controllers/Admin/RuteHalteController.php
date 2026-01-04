<?php

namespace App\Http\Controllers\Admin;
use App\Models\RuteHalte;
use App\Models\Rute;
use App\Models\Halte;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RuteHalteController extends Controller
{
    public function index()
    {
        $data = RuteHalte::with(['rute', 'halte'])
        ->orderBy('jam_berangkat', 'asc')
        ->get();
        return view('admin.rute-halte.index', compact('data'));
    }
    public function destroy($id)
    {
        $ruteHalte = RuteHalte::findOrFail($id);
        $ruteHalte->delete();

        return redirect()->route('admin.rute-halte.index')
            ->with('success', 'Data Rute-Halte berhasil dihapus!');
    }
    public function create()
    {
        return view('admin.rute-halte.create', [
            'rutes' => Rute::all(),
            'haltes' => Halte::all(),
        ]);
    }

   public function store(Request $request)
{
    $request->validate([
        'id_rute' => 'required|exists:rute,id',
        'id_halte' => [
            'required',
            'exists:halte,id',
            Rule::unique('rute_halte')->where(fn ($q) =>
                $q->where('id_rute', $request->id_rute)
            ),
        ],
        'jam_berangkat' => 'required',
    ]);

    RuteHalte::create([
        'id_rute' => $request->id_rute,
        'id_halte' => $request->id_halte,
        'jam_berangkat' => $request->jam_berangkat,
    ]);

    return redirect()
        ->route('admin.rute-halte.index')
        ->with('success', 'Rute-Halte berhasil ditambahkan');
}
public function edit($id)
{
    $ruteHalte = RuteHalte::with(['rute', 'halte'])->findOrFail($id);

    $rutes  = Rute::all();
    $haltes = Halte::all();

    return view('admin.rute-halte.edit', compact(
        'ruteHalte',
        'rutes',
        'haltes'
    ));
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_rute'       => 'required|exists:rute,id',
        'id_halte'      => 'required|exists:halte,id',
        'jam_berangkat' => 'required'
    ]);

    $ruteHalte = RuteHalte::findOrFail($id);

    $ruteHalte->update([
        'id_rute'       => $request->id_rute,
        'id_halte'      => $request->id_halte,
        'jam_berangkat' => $request->jam_berangkat
    ]);

    return redirect()
        ->route('admin.rute-halte.index')
        ->with('success', 'Data RuteHalte berhasil diperbarui');
}
}


