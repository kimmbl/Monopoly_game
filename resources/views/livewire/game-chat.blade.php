<div>
    <div class="chat-container-game border-bottom">
    @forelse ($messages as $message)
        @if($message->user->id != 1){{$message->user->name}}: @endif{{$message->message}}
        <br/>
    @empty
        <h1>Чат порожній.</h1>
    @endforelse
    </div>
    <div style="text-align: center; padding-top: 5px; ">
        <form wire:submit.prevent="sendMessage">
            <input wire:model.defer="messageText" type="text" style="width: 20vw; height: 3.7vh">
            <button type="submit" class="btn btn-outline-light form-responsive">Send</button>
        </form>
    </div>
</div>
