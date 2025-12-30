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
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'));

Route::post('/web-login', [WebAuth::class, 'login']);
Route::post('/web-register', [WebAuth::class, 'register']);
Route::post('/logout', [WebAuth::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER (PENUMPANG)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', WebRoleMiddleware::class . ':penumpang'])->group(function () {
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
    });
