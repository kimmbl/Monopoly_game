<?php


use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/inventory', [InventoryController::class, 'show'])->
middleware(['auth'])
    ->name('inventory');

Route::get('/profile/{id}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('profile');

Route::get('/admin', [UserController::class, 'showPlayers'])
    ->middleware('admin')
    ->name('adminPanel');

Route::get('/messages', [ChatController::class, 'fetchMessages'])
    ->middleware('auth');

Route::post('/messages', [ChatController::class, 'sendMessage'])
    ->middleware('auth');

Route::get('/lobbies', [LobbyController::class, 'show'])
    ->middleware('auth')->
    name('lobbies');

Route::get('/lobbies/get', [LobbyController::class, 'fetchLobbies'])
    ->middleware('auth');

Route::post('/lobbies', [LobbyController::class, 'createLobby'])
    ->middleware('auth')->name('createLobby');

Route::put('/lobbies', [LobbyController::class, 'joinToLobby'])
    ->middleware('auth')->name('joinToLobby');;

Route::put('/inventory', [InventoryController::class, 'changeActive'])
    ->middleware('auth')->name('inventory_put');

Route::put('/profile/change', [UserController::class, 'changePassword'])
    ->middleware('auth')
    ->name('change_password');

Route::get('/editProfile', function (){
    return view('editProfile');
})->middleware('auth');

Route::put('/editProfile', [UserController::class, 'editProfile'])
    ->middleware('auth')
    ->name('edit_profile');

Route::post('/addFriend', [FriendsController::class, 'addFriend'])
    ->middleware('auth')
    ->name('add_friend');

Route::delete('/deleteFriend', [FriendsController::class, 'deleteFriend'])
    ->middleware('auth')
    ->name('delete_friend');

Route::get('/friends', [FriendsController::class, 'showFriends'])
    ->middleware('auth')
    ->name('friends');

Route::get('/addFriend', function () {
    return view('addFriend', ['users' => null, 'empty' => false]);
})->middleware('auth')->name('addFriend');


Route::get('/addFriend/search', [FriendsController::class, 'searchUser'])
    ->middleware('auth')
    ->name('searchFriends');


Route::get('/test', function () {
    return view('test', ['user_id' => 2]);
})->middleware('auth')->name('test');

require __DIR__.'/game.php';
require __DIR__.'/auth.php';
require __DIR__.'/adminPanel.php';

