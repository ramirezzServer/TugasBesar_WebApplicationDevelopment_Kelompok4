<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalSopir;

class JadwalsopirController extends Controller
{
        public function index()
    {
        $data = JadwalSopir::all();

        return view('admin.Jadwal-sopir.index', compact('data'));
    }
}
