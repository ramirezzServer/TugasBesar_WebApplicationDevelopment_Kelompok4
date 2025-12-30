<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhan = Keluhan::with('user')->latest()->get();
        return view('admin.keluhan.index', compact('keluhan'));
    }
}
