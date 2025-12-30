<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Rute;

class RouteController extends Controller
{
    public function index(): View
    {
        // Ambil data rute langsung dari database
        $rute = Rute::with('halte')->get();

        return view('user.rute.index', compact('rute'));
    }
}
