<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index');
    }
}
