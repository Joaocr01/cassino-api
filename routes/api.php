<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SettingsController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/settings/data', [SettingsController::class, 'getSettings']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/verify', [AuthController::class, 'verify']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/game/roulette/spin', [GameController::class, 'rouletteSpin']);
    Route::post('/game/crash/start', [GameController::class, 'crashStart']);
    Route::post('/game/mines/play', [GameController::class, 'minesPlay']);
});
