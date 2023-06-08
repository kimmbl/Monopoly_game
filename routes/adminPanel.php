<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::put('/admin/mute', [UserController::class, 'mute'])
    ->middleware('moder')->name('mute');

Route::put('/admin/unmute', [UserController::class, 'unmute'])
    ->middleware('moder')->name('unmute');

Route::put('/admin/ban', [UserController::class, 'ban'])
    ->middleware('admin')->name('ban');

Route::put('/admin/unban', [UserController::class, 'unban'])
    ->middleware('admin')->name('unban');

Route::put('/admin/addModer', [UserController::class, 'addModer'])
    ->middleware('admin')->name('addModer');

Route::put('/admin/removeModer', [UserController::class, 'removeModer'])
    ->middleware('admin')->name('removeModer');

Route::get('/admin/search', [UserController::class, 'searchUser'])
    ->middleware('admin')->name('searchUser');

