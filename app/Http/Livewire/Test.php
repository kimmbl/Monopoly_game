<?php

namespace App\Http\Livewire;

use App\Models\Lobby;
use App\Models\Message;
use Livewire\Component;

class Test extends Component
{
    public $user_id;
    public $messageText;

    public function sendMessage(){
        Message::create([
            'user_id' => $this->user_id,
            'message' => $this->messageText
        ]);

        $this->reset('messageText');
    }

    public function render()
    {
        $messages = Message::with('user')
            ->latest()
            ->take(10)
            ->get()
            ->sortBy('id');
        return view('livewire.test', compact('messages'));
    }
}
