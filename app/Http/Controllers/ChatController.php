<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Stats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function fetchMessages(){
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request){
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        $stats = Stats::find(Auth::id());

        $stats->messages_sent++;
        $stats->save();

        broadcast(new MessageSent($user, $message))->toOthers();
    }
}
