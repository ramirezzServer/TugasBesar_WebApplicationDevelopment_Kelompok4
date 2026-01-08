<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Rute;

class RouteController extends Controller
{

    public function index()
    {

        $rute = Rute::with('ruteHalte.halte')->first()
            ->orderBy('jam_berangkat', 'asc')
            ->get();
        $now = date('H:i');

        return view('dashboard.index', compact('rute', 'now'));
        return view('user.rute.index', compact('data'));
    }
}
