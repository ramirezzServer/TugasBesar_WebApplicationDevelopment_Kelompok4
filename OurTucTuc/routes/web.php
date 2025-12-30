<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController as WebAuth;
use App\Http\Controllers\Web\UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KeluhanController as AdminKeluhan;
use App\Http\Controllers\Web\KeluhanController as UserKeluhan;
use App\Http\Controllers\Web\RouteController;
use App\Http\Middleware\WebRoleMiddleware;

/*
|--------------------------------------------------------------------------
| AUTH (WEB)
|--------------------------------------------------------------------------
*/

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'));

Route::post('/web-login', [WebAuth::class, 'login']);
Route::post('/web-register', [WebAuth::class, 'register']);
Route::post('/logout', [WebAuth::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER (PENUMPANG)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', WebRoleMiddleware::class . ':penumpang'])
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index']);
        Route::get('/keluhan', [UserKeluhan::class, 'index']);
        Route::get('/rute', [RouteController::class, 'index']);
    });

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', WebRoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index']);
        Route::get('/keluhan', [AdminKeluhan::class, 'index']);

        // =========================
        // DUMMY ROUTES (SEMENTARA)
        // =========================
        Route::get('/vehicles', function () {
            return view('admin.placeholder', [
                'title' => 'Manajemen Kendaraan'
            ]);
        });

        Route::get('/drivers', function () {
            return view('admin.placeholder', [
                'title' => 'Manajemen Sopir'
            ]);
        });

        Route::get('/routes', function () {
            return view('admin.placeholder', [
                'title' => 'Manajemen Rute'
            ]);
        });

        Route::get('/stations', function () {
            return view('admin.placeholder', [
                'title' => 'Manajemen Halte'
            ]);
        });

        Route::get('/schedules', function () {
            return view('admin.placeholder', [
                'title' => 'Jadwal Sopir'
            ]);
        });

        Route::get('/complaints', function () {
            return view('admin.placeholder', [
                'title' => 'Keluhan Penumpang'
            ]);
        });
    });

