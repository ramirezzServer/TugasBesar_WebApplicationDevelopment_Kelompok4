<?php

use App\Http\Controllers\ruteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::apiResource('rute', ruteController::class);
    Route::apiResource('halte', HalteController::class);

});
