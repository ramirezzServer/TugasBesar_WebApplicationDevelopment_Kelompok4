<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhan = Keluhan::where('id_penumpang', Auth::id())->latest()->get();
        return view('user.keluhan.index', compact('keluhan'));
    }
}
