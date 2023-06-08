<?php

namespace App\Http\Controllers;

use App\Models\Lobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function show($id)
    {
        $lobby = Lobby::where('token', $id)->first();

        if ($lobby)
            return view('game', ['lobby' => $lobby]);
        else
            return abort(404);
    }
}
