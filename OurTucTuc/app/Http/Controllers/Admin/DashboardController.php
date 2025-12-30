<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\Sopir;
use App\Models\Kendaraan;
use App\Models\RuteHalte;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalKeluhan' => Keluhan::count(),
            'totalSopir' => Sopir::count(),
            'totalKendaraan' => Kendaraan::count(),

            'data' => RuteHalte::with(['rute', 'halte'])->get(),
        ]);
    }
}
