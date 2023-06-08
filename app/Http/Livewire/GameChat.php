<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GameChat as Chat;

/**
 * @method static with(string $string)
 */
class GameChat extends Component
{
    public $lobby_id, $user_id, $messageText;

    public function sendMessage(){
        Chat::create([
            'user_id' => $this->user_id,
            'message' => $this->messageText,
            'lobby_id' => $this->lobby_id
        ]);

        $this->reset('messageText');
    }

    public function render()
    {
        $messages = Chat::with('user')
            ->where('lobby_id', $this->lobby_id)
            ->latest()
            ->get()
            ->sortBy('id');
        return view('livewire.game-chat', compact('messages'));
    }
}
