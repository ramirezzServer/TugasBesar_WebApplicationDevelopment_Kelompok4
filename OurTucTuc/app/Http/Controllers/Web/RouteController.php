<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Rute;

class RouteController extends Controller
{

     public function index()
    {
        $rutes = Rute::with(['rute_halte' => function($q){
    $q->orderBy('jam_berangkat', 'asc')
      ->with('halte');
}])->get();

        return view('user.rute.index', compact('rutes'));
    }

    // Untuk dashboard
    public function dashboard()
    {
        $rutes = Rute::with(['rute_halte' => function($q){
    $q->orderBy('jam_berangkat', 'asc')
      ->with('halte');
}])->get();

        $now = date('H:i');
        return view('user.dashboard.index', compact('rutes', 'now'));
    }
}
