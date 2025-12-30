<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halte;

class HalteController extends Controller
{
    public function index()
    {
        $data = Halte::all();

        return view('admin.halte.index', compact('data'));
    }
}
