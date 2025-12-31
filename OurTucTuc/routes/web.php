<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController as WebAuth;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Middleware\WebRoleMiddleware;

// USER
use App\Http\Controllers\Web\UserDashboardController;
use App\Http\Controllers\Web\KeluhanController as UserKeluhan;
use App\Http\Controllers\Web\RouteController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KeluhanController as AdminKeluhan;
use App\Http\Controllers\Admin\SopirController as AdminSopir;
use App\Http\Controllers\Admin\KendaraanController as AdminKendaraan;
use App\Http\Controllers\Admin\RuteController as AdminRute;
use App\Http\Controllers\Admin\HalteController as AdminHalte;
use App\Http\Controllers\Admin\RuteHalteController as AdminRH;
use App\Http\Controllers\Admin\JadwalSopirController as AdminJS;
use App\Http\Controllers\Admin\UserController as AdminUser;

/*
| AUTH
*/
Route::get('/', fn() => view('auth.login'))->name('login');
Route::get('/login', fn() => view('auth.login'));
Route::get('/register', fn() => view('auth.register'));

Route::post('/web-login', [WebAuth::class, 'login'])->name('web.login');
Route::post('/web-register', [WebAuth::class, 'register'])->name('web.register');
Route::post('/logout', [WebAuth::class, 'logout'])->name('logout');

/*
| PROFILE (ADMIN & USER)
*/
Route::middleware('auth')
    ->get('/profile', [ProfileController::class, 'index'])
    ->name('profile');

/*
| USER
*/
Route::middleware(['auth', WebRoleMiddleware::class . ':penumpang'])
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('user.dashboard');

        Route::get('/rute', [RouteController::class, 'index'])
            ->name('user.rute');

        Route::get('/keluhan', [UserKeluhan::class, 'index'])
            ->name('user.keluhan');
    });

/*
| ADMIN
*/
Route::middleware(['auth', WebRoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/keluhan', [AdminKeluhan::class, 'index'])->name('keluhan');
        Route::put('/keluhan/{id}', [AdminKeluhan::class, 'update']);

        Route::get('/user', [AdminUser::class, 'index'])->name('user');
        Route::get('/sopir', [AdminSopir::class, 'index'])->name('sopir');
        Route::get('/kendaraan', [AdminKendaraan::class, 'index'])->name('kendaraan');
        Route::get('/halte', [AdminHalte::class, 'index'])->name('halte');
        Route::get('/rute', [AdminRute::class, 'index'])->name('rute');
        Route::get('/rute-halte', [AdminRH::class, 'index'])->name('rute-halte');
        Route::get('/jadwal-sopir', [AdminJS::class, 'index'])->name('jadwal-sopir');
    });
