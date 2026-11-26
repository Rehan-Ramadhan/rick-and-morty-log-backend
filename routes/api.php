<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DimensionController;
use App\Http\Controllers\CharLogController;

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // dimensions
    Route::apiResource('dimensions', DimensionController::class);

    // char logs
    Route::apiResource('char-logs', CharLogController::class);
});
