<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::withCount([
            'keluhans as keluhans_count' ])
            ->get();
        return view('admin.user.index', compact('data'));
    }
}
