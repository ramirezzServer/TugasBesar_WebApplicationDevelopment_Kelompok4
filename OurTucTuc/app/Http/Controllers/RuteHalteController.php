<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuteHalte;
use App\Http\Resources\RuteHalteResource;

class RuteHalteController extends Controller
{
    public function index()
    {
        $data = RuteHalte::with(['rute', 'halte'])->get();
        return RuteHalteResource::collection($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_rute' => ['required', 'exists:rute,id'],
            'id_halte' => ['required', 'exists:halte,id'],
            'jam_berangkat' => ['required', 'date_format:H:i'],

        ]);

        return RuteHalte::create($request->all());
    }


    public function search(Request $request)
    {
        $request->validate([
            'q' => ['required', 'string']
        ]);

        $q = $request->q;

        $rute_halte =RuteHalte::with(['rute', 'halte'])
            ->where('jam_berangkat', 'like', "%{$q}%");

        $Rute_halte = $rute_halte->latest()->get();

        return RuteHalteResource::collection($Rute_halte);
    }


    public function show($id)
    {
        return RuteHalte::with(['rute', 'halte'])->findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $rh = RuteHalte::findOrFail($id);
        $data = $request->validate([
            'id_rute' => ['sometimes', 'exists:rute,id'],
            'id_halte' => ['sometimes', 'exists:halte,id'],
            'jam_berangkat' => ['sometimes', 'date_format:H:i'],
        ]);
        $rh->update($data);
        return $rh;
    }

    public function destroy($id)
    {
        RuteHalte::destroy($id);
        return response()->json(['message' => 'Rute Halte deleted succsessfully']);
    }
}
