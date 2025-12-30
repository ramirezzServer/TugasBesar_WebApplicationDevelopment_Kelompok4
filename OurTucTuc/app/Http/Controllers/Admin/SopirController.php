<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sopir;

class SopirController extends Controller
{
    public function index()
    {
        $data = Sopir::all();

        return view('admin.sopir.index', compact('data'));
    }
}
