<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rute;

class RuteController extends Controller
{
    public function index()
    {
        $data = Rute::all();

        return view('admin.rute.index', compact('data'));
    }
}
