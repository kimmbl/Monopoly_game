<?php

namespace App\Http\Livewire;

use App\Models\GameItems;
use App\Models\GameProperties;
use App\Models\Games;
use App\Models\Properties;
use Livewire\Component;

class Board extends Component
{
    public $lobby_id, $game_items;
    public $properties, $game;
    public $live_properties;

    public function game(){
        $this->live_properties = GameProperties::where('game_id', $this->lobby_id)
            ->get();
        $this->game_items = GameItems::where('game_id', $this->lobby_id)->first();
        $this->game = Games::where('game_id', $this->lobby_id)->first();

        return view('livewire.board');
    }

    public function render()
    {
        $this->live_properties = GameProperties::where('game_id', $this->lobby_id)->get();
        $this->properties = Properties::get();
        $this->game_items = GameItems::where('game_id', $this->lobby_id)->first();
        $this->game = Games::where('game_id', $this->lobby_id)->first();

        return view('livewire.board');
    }
}
