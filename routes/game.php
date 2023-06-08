<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LobbyController;
use Illuminate\Support\Facades\Route;

Route::get('/game/{id}', [GameController::class, 'show'])
    ->middleware('auth')
    ->name('joinGame');

Route::put('/leave', [LobbyController::class, 'leaveLobby'])
    ->middleware('auth')
    ->name('exitGame');
