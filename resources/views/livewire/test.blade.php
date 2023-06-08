<div>
    @forelse ($messages as $message)
        {{$message->user->name}}: {{$message->message}}
        <br/>
    @empty
        <h1>No messages yet. Type one below!</h1>
    @endforelse
    <div class="mt-6 border-top" style="bottom: 0">
        <form wire:submit.prevent="sendMessage">
            <input wire:model.defer="messageText" type="text">
            <button type="submit" class="btn btn-success">Send</button>
        </form>
    </div>
</div>
