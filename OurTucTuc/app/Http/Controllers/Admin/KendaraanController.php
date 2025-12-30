<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $data = Kendaraan::all();

        return view('admin.kendaraan.index', compact('data'));
    }
}
