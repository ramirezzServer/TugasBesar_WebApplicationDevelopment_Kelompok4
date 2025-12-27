<?php

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [UserController::class, 'me']);
    Route::match(['put', 'patch'], '/me', [UserController::class, 'updateMe']);

    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('kendaraan', KendaraanController::class);
    Route::apiResource('rute', ruteController::class);
    Route::apiResource('sopir', SopirController::class);
    Route::apiResource('halte', HalteController::class);
    Route::apiResource('rute-halte', RuteHalteController::class);
    Route::apiResource('jadwal-sopir', JadwalSopirController::class);
    Route::apiResource('keluhan', KeluhanController::class);
});