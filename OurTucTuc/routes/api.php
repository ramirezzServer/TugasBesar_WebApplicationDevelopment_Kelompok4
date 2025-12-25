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

/**
 * =============1================
 * unprotected routes for user registration and login
 */


Route::middleware('auth:sanctum')->group(function () {

    /**
     * ============2================
     * user logout route
     */

    /**
     * ============3================
     * auth API routes
     */

    /**
     * ============4================
     * user API routes
     */

    /**
     * 
     * ============5================
     * sopir API routes
     */
    

    /**
     * ============6================
     * kendaraan API routes
     */

    /**
     * ============7================
     * rute halte API routes
     */
    Route::apiResource('rute-halte', RuteHalteController::class);

    /**
     * ============9================
     * jadwal Sopir API routes
     */


    /**
     * ============10================
     * halte API routes
     */

    Route::apiResource('halte', HalteController::class);
    /**
     * ============11================
     * rute API routes
     */


    /**
     * ============10================
     * keluhan API routes
     */




});

