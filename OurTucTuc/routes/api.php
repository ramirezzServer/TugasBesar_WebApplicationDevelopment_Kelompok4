<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HalteController;
use App\Http\Controllers\ruteController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\JadwalSopirController;
use App\Http\Controllers\RuteHalteController;

//buat public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//allrole after auth
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);

    /* ================= HALTE ================= */
    Route::get('/halte', [HalteController::class, 'index']);
    Route::get('/halte/{id}', [HalteController::class, 'show']);

    /* ================= RUTE ================= */
    Route::get('/rute', [RuteController::class, 'index']);
    Route::get('/rute/{id}', [RuteController::class, 'show']);
});

//buat penumpang
Route::middleware(['auth:sanctum', 'role:penumpang'])->group(function () {

    /* ================= KELUHAN ================= */
    Route::get('/keluhan', [KeluhanController::class, 'index']);
    Route::post('/keluhan', [KeluhanController::class, 'store']);
    Route::get('/keluhan/{id}', [KeluhanController::class, 'show']);
    Route::put('/keluhan/{id}', [KeluhanController::class, 'update']);
    Route::delete('/keluhan/{id}', [KeluhanController::class, 'destroy']);
});


//buat admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    /* ================= HALTE ================= */
    Route::post('/halte', [HalteController::class, 'store']);
    Route::put('/halte/{id}', [HalteController::class, 'update']);
    Route::delete('/halte/{id}', [HalteController::class, 'destroy']);

    /* ================= RUTE ================= */
    Route::post('/rute', [RuteController::class, 'store']);
    Route::put('/rute/{id}', [RuteController::class, 'update']);
    Route::delete('/rute/{id}', [RuteController::class, 'destroy']);

    /* ================= KENDARAAN ================= */
    Route::get('/kendaraan', [KendaraanController::class, 'index']);
    Route::post('/kendaraan', [KendaraanController::class, 'store']);
    Route::get('/kendaraan/{id}', [KendaraanController::class, 'show']);
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);

    /* ================= SOPIR ================= */
    Route::get('/sopir', [SopirController::class, 'index']);
    Route::post('/sopir', [SopirController::class, 'store']);
    Route::get('/sopir/{id}', [SopirController::class, 'show']);
    Route::put('/sopir/{id}', [SopirController::class, 'update']);
    Route::delete('/sopir/{id}', [SopirController::class, 'destroy']);

    /* ================= RUTE - HALTE ================= */
    Route::get('/rute-halte', [RuteHalteController::class, 'index']);
    Route::post('/rute-halte', [RuteHalteController::class, 'store']);
    Route::get('/rute-halte/{id}', [RuteHalteController::class, 'show']);
    Route::put('/rute-halte/{id}', [RuteHalteController::class, 'update']);
    Route::delete('/rute-halte/{id}', [RuteHalteController::class, 'destroy']);

    /* ================= JADWAL SOPIR ================= */
    Route::get('/jadwal-sopir', [JadwalSopirController::class, 'index']);
    Route::post('/jadwal-sopir', [JadwalSopirController::class, 'store']);
    Route::get('/jadwal-sopir/{id}', [JadwalSopirController::class, 'show']);
    Route::put('/jadwal-sopir/{id}', [JadwalSopirController::class, 'update']);
    Route::delete('/jadwal-sopir/{id}', [JadwalSopirController::class, 'destroy']);
});
