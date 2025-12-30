<?php

namespace App\Http\Controllers\Admin;
use App\Models\RuteHalte;
use App\Http\Controllers\Controller;

class RuteHalteController extends Controller
{
    public function index()
    {
        $data = RuteHalte::with(['rute', 'halte'])->get();
        return view('admin.rute-halte.index', compact('data'));
    }

}
