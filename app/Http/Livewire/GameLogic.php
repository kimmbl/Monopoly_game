<?php

namespace App\Http\Livewire;

use App\Models\Games;
use App\Models\Lobby;
use Livewire\Component;

class GameLogic extends Component
{
    public $lobby_id;
    public $lobby, $game;

    public function render()
    {
        $this->lobby = Lobby::find($this->lobby_id);
        $this->game = Games::where('game_id', $this->lobby_id)->first();

        return view('livewire.game-logic');
    }
}
