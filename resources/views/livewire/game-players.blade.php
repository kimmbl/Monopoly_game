<div>
    @if(!$lobby->user1 && !$lobby->user2 && !$lobby->user3 && !$lobby->user4)
        <div class="cell-info" id="player1-info" style="background-color: whitesmoke" @click="open = true">
            <p style="display:inline">Бракує гравців</p>
            <br><br>
        </div>
    @elseif($lobby->user1)
        <div x-data="{ open: false }" style="display: inline-block">
            <div class="cell-info user1" id="player1-info" @click="open = true">
                <p id="player1-info_name" style="display:inline">{{$lobby->user1->name}}</p>
                <p id="player1-info_cash">{{$game_money->user1_money}} USD</p>
            </div>
            <div x-show="open" @click.away="open = false" class="dropdown-content">
                @if($lobby->user1_id == Auth::id())
                    <form action="{{route('exitGame')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-danger form-responsive" type="submit">Вийти</button>
                        <input type="hidden" name="user_left" value="user1_id">
                        <input type="hidden" name="lobby_id" value="{{$lobby->id}}">
                    </form>
                @else
                    <a class="btn btn-primary form-responsive" href="{{route('profile', ['id' => $lobby->user1_id])}}"
                       target="_blank">Профіль</a>
                @endif
            </div>
        </div>
    @endif
    @if($lobby->user2)
        <div x-data="{ open: false }" style="display: inline-block">
            <div class="cell-info user2" id="player2-info" @click="open = true">
                <p id="player2-info_name" style="display:inline">{{$lobby->user2->name}}</p>
                <br>
                <p id="player2-info_cash">{{$game_money->user2_money}} USD</p>
            </div>
            <div x-show="open" @click.away="open = false" class="dropdown-content">
                @if($lobby->user2_id == Auth::id())
                    <form action="{{route('exitGame')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-danger form-responsive" type="submit">Вийти</button>
                        <input type="hidden" name="user_left" value="user2_id">
                        <input type="hidden" name="name_left" value="{{$lobby->user2->name}}">
                        <input type="hidden" name="lobby_id" value="{{$lobby->id}}">
                    </form>
                @else
                    <a class="btn btn-primary form-responsive" href="{{route('profile', ['id' => $lobby->user2_id])}}"
                       target="_blank">Профіль</a>
                @endif
            </div>
        </div>
    @endif
    @if($lobby->user3)
        <div x-data="{ open: false }" style="display: inline-block">
            <div class="cell-info user3" id="player3-info" @click="open = true">
                <p id="player3-info_name" style="display:inline">{{$lobby->user3->name}} <p class='token'
                                                                                            id="player3-info_token"></p>
                <br>
                <p id="player3-info_cash">{{$game_money->user3_money}} USD</p>
            </div>
            <div x-show="open" @click.away="open = false" class="dropdown-content">
                @if($lobby->user3_id == Auth::id())
                    <form action="{{route('exitGame')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-danger form-responsive" type="submit">Вийти</button>
                        <input type="hidden" name="user_left" value="user3_id">
                        <input type="hidden" name="name_left" value="{{$lobby->user3->name}}">
                        <input type="hidden" name="lobby_id" value="{{$lobby->id}}">
                    </form>
                @else
                    <a class="btn btn-primary form-responsive" href="{{route('profile', ['id' => $lobby->user3_id])}}"
                       target="_blank">Профіль</a>
                @endif
            </div>
        </div>
    @endif
    @if($lobby->user4)
        <div x-data="{ open: false }" style="display: inline-block">
            <div class="cell-info user4" id="player4-info" @click="open = true">
                <p id="player4-info_name" style="display:inline">{{$lobby->user4->name}} <p class='token'
                                                                                            id="player4-info_token"></p>
                <br>
                <p id="player4-info_cash">{{$game_money->user4_money}} USD</p>
            </div>
            <div x-show="open" @click.away="open = false" class="dropdown-content">
                @if($lobby->user4_id == Auth::id())
                    <form action="{{route('exitGame')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-danger form-responsive" type="submit">Вийти</button>
                        <input type="hidden" name="user_left" value="user4_id">
                        <input type="hidden" name="name_left" value="{{$lobby->user4->name}}">
                        <input type="hidden" name="lobby_id" value="{{$lobby->id}}">
                    </form>
                @else
                    <a class="btn btn-primary form-responsive" href="{{route('profile', ['id' => $lobby->user4_id])}}"
                       target="_blank">Профіль</a>
                @endif
            </div>
        </div>
    @endif
</div>
