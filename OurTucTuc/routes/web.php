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
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('auth.login'))
    ->name('login');

Route::get('/login', fn() => view('auth.login'));

Route::get('/register', fn() => view('auth.register'));

Route::post('/web-login', [WebAuth::class, 'login'])
    ->name('web.login');

Route::post('/web-register', [WebAuth::class, 'register'])
    ->name('web.register');

Route::post('/logout', [WebAuth::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PROFILE (ADMIN & USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| USER (ROLE: penumpang)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', WebRoleMiddleware::class . ':penumpang'])
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('user.dashboard');

        Route::get('/dashboard/data', [UserDashboardController::class, 'data'])
            ->name('user.dashboard.data');

        Route::get('/rute', [RouteController::class, 'index'])
            ->name('user.rute');

        // USER KELUHAN (CRUD TANPA UBAH STATUS)
        Route::get('/keluhan', [UserKeluhan::class, 'index'])
            ->name('user.keluhan');

        Route::post('/keluhan', [UserKeluhan::class, 'store'])
            ->name('user.keluhan.store');

        Route::get('/keluhan/{id}/edit', [UserKeluhan::class, 'edit'])
            ->name('user.keluhan.edit');

        Route::put('/keluhan/{id}', [UserKeluhan::class, 'update'])
            ->name('user.keluhan.update');

        Route::delete('/keluhan/{id}', [UserKeluhan::class, 'destroy'])
            ->name('user.keluhan.destroy');
    });

/*
|--------------------------------------------------------------------------
| ADMIN (ROLE: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', WebRoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/keluhan', [AdminKeluhan::class, 'index'])
            ->name('keluhan');

        Route::put('/keluhan/{id}', [AdminKeluhan::class, 'update'])
            ->name('keluhan.update');

        Route::get('/user', [AdminUser::class, 'index'])
            ->name('user');

        Route::get('/sopir', [AdminSopir::class, 'index'])
            ->name('sopir.index');

        Route::get('/sopir/create', [AdminSopir::class, 'create'])
            ->name('sopir.create');

        Route::post('/sopir', [AdminSopir::class, 'store'])
            ->name('sopir.store');

        Route::get('/sopir/{id}/edit', [AdminSopir::class, 'edit'])
            ->name('sopir.edit');

        Route::put('/sopir/{id}', [AdminSopir::class, 'update'])
            ->name('sopir.update');

        Route::delete('/sopir/{id}', [AdminSopir::class, 'destroy'])
            ->name('sopir.destroy');

        Route::get('/kendaraan', [AdminKendaraan::class, 'index'])
            ->name('kendaraan.index');

        Route::post('/kendaraan', [AdminKendaraan::class, 'store'])
            ->name('kendaraan.store');

        Route::put('/kendaraan/{id}', [AdminKendaraan::class, 'update'])
            ->name('kendaraan.update');

        Route::delete('/kendaraan/{id}', [AdminKendaraan::class, 'destroy'])
            ->name('kendaraan.destroy');

        Route::get('/halte', [AdminHalte::class, 'index'])
            ->name('halte.index');

        Route::get('/halte/create', [AdminHalte::class, 'create'])
            ->name('halte.create');

        Route::post('/halte', [AdminHalte::class, 'store'])
            ->name('halte.store');

        Route::get('/halte/{id}/edit', [AdminHalte::class, 'edit'])
            ->name('halte.edit');

        Route::put('/halte/{id}', [AdminHalte::class, 'update'])
            ->name('halte.update');

        Route::delete('/halte/{id}', [AdminHalte::class, 'destroy'])
            ->name('halte.destroy');
        Route::get('/rute', [AdminRute::class, 'index'])
            ->name('rute.index');

        Route::get('/rute/create', [AdminRute::class, 'create'])
            ->name('rute.create');

        Route::post('/rute', [AdminRute::class, 'store'])
            ->name('rute.store');

        Route::get('/rute/{id}/edit', [AdminRute::class, 'edit'])
            ->name('rute.edit');

        Route::put('/rute/{id}', [AdminRute::class, 'update'])
            ->name('rute.update');

        Route::delete('/rute/{id}', [AdminRute::class, 'destroy'])
            ->name('rute.destroy');

        Route::get('/rute-halte', [AdminRH::class, 'index'])
            ->name('rute-halte.index');

        Route::get('/admin/rute-halte/create', [AdminRH::class, 'create'])
            ->name('rute-halte.create');

        Route::post('/admin/rute-halte', [AdminRH::class, 'store'])
            ->name('rute-halte.store');

        Route::delete('rute-halte/{id}', [AdminRH::class, 'destroy'])
            ->name('rute-halte.destroy');

        Route::get('/admin/rute-halte/{id}/edit', [AdminRH::class, 'edit'])
            ->name('rute-halte.edit');

        Route::put('/admin/rute-halte/{id}', [AdminRH::class, 'update'])
            ->name('rute-halte.update');

        Route::get('/jadwal-sopir', [AdminJS::class, 'index'])
            ->name('jadwal-sopir');

        Route::get('/jadwal-sopir/create', [AdminJS::class, 'create'])
            ->name('jadwal-sopir.create');

        Route::post('/jadwal-sopir', [AdminJS::class, 'store'])
            ->name('jadwal-sopir.store');

        Route::get('/jadwal-sopir/{id}/edit', [AdminJS::class, 'edit'])
            ->name('jadwal-sopir.edit');

        Route::put('/jadwal-sopir/{id}', [AdminJS::class, 'update'])
            ->name('jadwal-sopir.update');

        Route::delete('/jadwal-sopir/{id}', [AdminJS::class, 'destroy'])
            ->name('jadwal-sopir.destroy');
    }
);
