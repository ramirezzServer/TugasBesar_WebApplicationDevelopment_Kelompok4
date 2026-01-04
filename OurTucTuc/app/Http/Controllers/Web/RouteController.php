<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\RuteHalte;

class RouteController extends Controller
{

    public function index()
    {
        $data = RuteHalte::with(['rute', 'halte'])
            ->orderBy('jam_berangkat', 'asc')
            ->get();
        return view('user.rute.index', compact('data'));
    }
}
