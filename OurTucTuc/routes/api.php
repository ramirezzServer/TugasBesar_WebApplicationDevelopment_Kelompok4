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
use App\Http\Controllers\RuteController;
use App\Http\Controllers\KeluhanController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('kendaraan', KendaraanController::class);
    Route::apiResource('rute', ruteController::class);
    Route::apiResource('sopir', SopirController::class);
    Route::apiResource('halte', HalteController::class);
    Route::apiResource('rute-halte', RuteHalteController::class);
    Route::apiResource('jadwal-sopir', JadwalSopirController::class);
    Route::apiResource('keluhan', KeluhanController::class);
    Route::apiResource('user', UserController::class);
});
