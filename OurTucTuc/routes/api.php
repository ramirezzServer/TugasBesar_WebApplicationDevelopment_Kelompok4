<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\RuteHalteController;
use App\Http\Controllers\JadwalSopirController;
use App\Http\Controllers\HalteController;
use App\Http\Controllers\ruteController;
use App\Http\Controllers\KeluhanController;

/*
|--------------------------------------------------------------------------
| AUTH (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    /*
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/update-profile', [AuthController::class, 'updateProfile']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    */
    // Resources
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('kendaraan', KendaraanController::class);
    Route::apiResource('rute', ruteController::class);
    Route::apiResource('sopir', SopirController::class);
    Route::apiResource('halte', HalteController::class);
    Route::apiResource('rute-halte', RuteHalteController::class);
    Route::apiResource('jadwal-sopir', JadwalSopirController::class);
    Route::apiResource('keluhan', KeluhanController::class);
});
