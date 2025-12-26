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
            'id_rute' => 'required|exists:rute,id',
            'id_halte' => 'required|exists:halte,id',
            'jam_berangkat' => 'required'
        ]);

        return RuteHalte::create($request->all());
    }

     public function show($id)
    {
        return RuteHalte::with(['rute', 'halte'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rh = RuteHalte::findOrFail($id);
        $rh->update($request->all());
        return $rh;
    }

      public function destroy($id)
    {
        RuteHalte::destroy($id);
        return response()->json(['message' => 'Rute Halte deleted succsessfully']);
    }
}
