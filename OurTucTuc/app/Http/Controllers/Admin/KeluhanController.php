<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhan = Keluhan::with(['penumpang'])->latest()->get();
        return view('admin.keluhan.index', compact('keluhan'));


    }
}
