<?php

namespace App\Http\Controllers;

use App\Models\GameChat;
use App\Models\GameItems;
use App\Models\GameMoney;
use App\Models\GameProperties;
use App\Models\Games;
use App\Models\Inventory;
use App\Models\Lobby;
use App\Models\Properties;
use App\Models\Stats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Events\LobbyCreated;

class LobbyController extends Controller
{
    public function show()
    {
        $lobbies = DB::table('lobbies')
            ->where('is_started', '0')
            ->where('is_ended', '0')
            ->get();


        $active_lobby = DB::table('lobbies')
            ->where('is_started', '1')
            ->where('is_ended', '0')
            ->where(function($query) {
                $query->where('user1_id', Auth::id())
                    ->orWhere('user2_id', Auth::id())
                    ->orWhere('user3_id', Auth::id())
                    ->orWhere('user4_id', Auth::id());
            })
            ->first();

        return view('lobbies', [
            'lobbies' => $lobbies,
            'active_lobby' => $active_lobby
        ]);
    }

    public function fetchLobbies()
    {
        return Lobby::with('user1')->get();
    }

    public static function searchUser($user_id)
    {
        return User::find($user_id);
    }

    public function joinToLobby(Request $request)
    {
        $lobby = Lobby::find($request->input('lobby'));
        $user = null;
        $connect = false;
        $item_id = Inventory::where('user_id', Auth::id())
            ->where('is_chosen_pawn', 1)
            ->select('item_id')
            ->first()
            ->item_id;


        if ($lobby->user1_id == Auth::id())
            $connect = true;
        else {
            $user = Lobby::where('is_ended', '0')
                ->where(function($query) {
                    $query->where('user1_id', Auth::id())
                        ->orWhere('user2_id', Auth::id())
                        ->orWhere('user3_id', Auth::id())
                        ->orWhere('user4_id', Auth::id());
                })->first();
        }

        if ($user) {
            return redirect()->back()->with('alert', 'cant_enter');
        }

        if (!$connect) {
            if (!$lobby->user2_id) {
                $lobby->user2_id = Auth::id();
                $lobby->save();
                GameItems::where('game_id', $lobby->id)->update(['user2_item' => $item_id]);
                Games::where('game_id', $lobby->id)->update(['user2_field' => 1]);
                GameMoney::where('game_id', $lobby->id)->update(['user2_money' => 1500]);
            } else if (!$lobby->user3_id) {
                $lobby->user3_id = Auth::id();
                $lobby->save();
                GameItems::where('game_id', $lobby->id)->update(['user3_item' => $item_id]);
                Games::where('game_id', $lobby->id)->update(['user3_field' => 1]);
                GameMoney::where('game_id', $lobby->id)->update(['user3_money' => 1500]);
            } else if (!$lobby->user4_id) {
                $lobby->user4_id = Auth::id();
                $lobby->save();
                GameItems::where('game_id', $lobby->id)->update(['user4_item' => $item_id]);
                Games::where('game_id', $lobby->id)->update(['user4_field' => 1]);
                GameMoney::where('game_id', $lobby->id)->update(['user4_money' => 1500]);
            } else
                return redirect()->back()->with('alert', 'places_taken');
        }

        GameChat::create([
            'user_id' => 1,
            'message' => Auth::user()->name . ' приєднався.',
            'lobby_id' => $lobby->id
        ]);

        return redirect()->route('joinGame', ['id' => $lobby->token]);
    }

    public function createLobby(Request $request)
    {
        $is_lobby = Lobby::where('user1_id', Auth::id())->first();
        $properties = Properties::select('id', 'price')->get();
        $item_id = Inventory::where('user_id', Auth::id())
            ->where('is_chosen_pawn', 1)
            ->select('item_id')
            ->first()
            ->item_id;

        if (!$is_lobby) {
            $user = Auth::user();
            $str = Str::random(20);

            $lobby = $user->lobby_slot1()->create([
                'user1_id' => Auth::id(),
                'token' => $str
            ]);

            foreach ($properties as $property){
                GameProperties::create([
                    'game_id' => $lobby->id,
                    'property_id' => $property->id,
                    'price' => $property->price
                ]);
            }

            GameItems::create([
                'game_id' => $lobby->id,
                'user1_item' => $item_id
            ]);

            Games::create([
               'game_id' => $lobby->id,
               'user1_field' => 1
            ]);

            GameMoney::create([
                'game_id' => $lobby->id,
                'user1_money' => 1500
            ]);

            GameChat::create([
                'user_id' => 1,
                'message' => 'Гру створено.',
                'lobby_id' => $lobby->id
            ]);

            return redirect()->route('joinGame', ['id' => $str]);
        } else {
            return redirect()->back()->with('alert', 'lobby_exists');
        }
    }

    public function leaveLobby(Request $request){
        $lobby = Lobby::find($request->lobby_id);
        if(!$lobby->is_started){
            if($request->user_left == 'user1_id'){
                $lobby->is_ended = true;
                $lobby->user1_id = null;
                $lobby->save();
                GameChat::create([
                    'user_id' => 1,
                    'message' => 'Власник лоббі відключився. Лоббі закрито.',
                    'lobby_id' => $lobby->id
                ]);
            } else {
                Lobby::where('id', $request->lobby_id)
                    ->update([$request->user_left => null]);
                GameChat::create([
                    'user_id' => 1,
                    'message' => $request->name_left . ' відключився.',
                    'lobby_id' => $lobby->id
                ]);
            }
        } else {
            Lobby::where('id', $request->lobby_id)
                ->update([$request->user_left => null]);
            GameChat::create([
                'user_id' => 1,
                'message' => $request->name_left . ' відключився.',
                'lobby_id' => $lobby->id
            ]);
        }

        return redirect()->route('dashboard');
    }
}

