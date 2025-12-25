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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('keluhan', KeluhanController::class);
});
