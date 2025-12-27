<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HalteController;
use App\Http\Controllers\ruteController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SopirController;

/*
|--------------------------------------------------------------------------
| AUTH - ALL (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| DATA MASTER - ALL (READ ONLY)
|--------------------------------------------------------------------------
| Bisa diakses Admin & Penumpang
*/
Route::get('/halte', [HalteController::class, 'index']);
Route::get('/halte/{id}', [HalteController::class, 'show']);

Route::get('/rute', [ruteController::class, 'index']);
Route::get('/rute/{id}', [ruteController::class, 'show']);

Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::get('/kendaraan/{id}', [KendaraanController::class, 'show']);

Route::get('/sopir', [SopirController::class, 'index']);
Route::get('/sopir/{id}', [SopirController::class, 'show']);


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER (ALL ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // logout bisa semua role
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        // HALTE
        Route::post('/halte', [HalteController::class, 'store']);
        Route::put('/halte/{id}', [HalteController::class, 'update']);
        Route::delete('/halte/{id}', [HalteController::class, 'destroy']);

        // RUTE
        Route::post('/rute', [ruteController::class, 'store']);
        Route::put('/rute/{id}', [ruteController::class, 'update']);
        Route::delete('/rute/{id}', [ruteController::class, 'destroy']);

        // KENDARAAN
        Route::post('/kendaraan', [KendaraanController::class, 'store']);
        Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
        Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);

        // SOPIR
        Route::post('/sopir', [SopirController::class, 'store']);
        Route::post('/sopir/{sopir}', [SopirController::class, 'update']);
        Route::delete('/sopir/{id}', [SopirController::class, 'destroy']);
    });
});
