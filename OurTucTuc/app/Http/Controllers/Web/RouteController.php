<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Rute;

class RouteController extends Controller
{
    public function index()
    {
        $rute = Rute::all();
        return view('user.rute.index', compact('rute'));
    }
}
