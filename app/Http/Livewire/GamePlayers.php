<?php

namespace App\Http\Livewire;

use App\Models\GameMoney;
use App\Models\Inventory;
use App\Models\Lobby;
use Livewire\Component;

class GamePlayers extends Component
{
    public $lobby_id;
    public $lobby, $game_money;

    public function render()
    {
        $this->lobby = Lobby::with('user1')
            ->with('user2')
            ->with('user3')
            ->with('user4')
            ->find($this->lobby_id);

        $this->game_money = GameMoney::where('game_id', $this->lobby_id)->first();

        return view('livewire.game-players');
    }
}
