@extends('livewire.game')
@section('board')
    <div class="responsive-game">
        <div class="mainSquare">
            <div class="row-game top-game">
                @for($i = 20; $i < 31; $i++)
                    <div
                        class="@if($properties[$i]->type == 'corner')square2 @else square1 @endif topSide {{$properties[$i]->family}}">
                        @if($properties[$i]->type == 'corner')
                            <span class="corner corner{{$properties[$i]->id}}">{{$properties[$i]->name}}</span>
                        @else
                            @if($properties[$i]->type == 'field')
                                <div
                                    class="header-game header-top white @if($live_properties[$i]->user_id) user{{$live_properties[$i]->user_id}} @endif"></div>
                            @endif
                            <div
                                class="firstLine firstLine-top rotation2">
                                <b>{{$properties[$i]->name}}</b> @if($properties[$i]->type == 'field' && $live_properties[$i]->rent)
                                    <br>Оренда:<br> {{$live_properties[$i]->rent}}$ 
                                    @elseif($properties[$i]->type == 'field') <br>
                                    {{$live_properties[$i]->price}}$ @endif </div>
                        @endif
                        <div class="player-tokens topSide">
                            @if($game_items->user1_item && ($game->user1_field == $properties[$i]->id))
                                <span class="player-pawn" id="player1-{{$game_items->user1_item}}"></span>
                            @endif
                            @if($game_items->user2_item && ($game->user2_field == $properties[$i]->id))
                                <span class="player-pawn" id="player2-{{$game_items->user2_item}}"></span>
                            @endif
                            @if($game_items->user3_item)
                                @if($game->user3_field == $properties[$i]->id)
                                    <span class="player-pawn" id="player3-{{$game_items->user3_item}}"></span>
                                @endif
                            @endif
                            @if($game_items->user4_item )
                                @if($game->user4_field == $properties[$i]->id)
                                    <span class="player-pawn" id="player4-{{$game_items->user4_item}}"></span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endfor
            </div>

            <div class="row-game center-game">
                <div class="square2">
                    @for($i = 19; $i > 10; $i--)
                        <div class="squareSide leftSide {{$properties[$i]->family}}">
                            @if($properties[$i]->type == 'field')
                                <div
                                    class="headerSide header-left white @if($live_properties[$i]->user_id) user{{$live_properties[$i]->user_id}} @endif"></div>
                            @endif
                            <div
                                class="firstLine firstLine-left {{$properties[$i]->type}} rotation1">
                                <b>{{$properties[$i]->name}}</b> @if($properties[$i]->type == 'field' && !$live_properties[$i]->rent)
                                    <br>{{$live_properties[$i]->price}}$ @elseif($live_properties[$i]->rent) <br>
                                    Оренда: {{$live_properties[$i]->rent}}$ @endif </div>
                            <div class="player-tokens leftSide">
                                @if($game_items->user1_item && ($game->user1_field == $properties[$i]->id))
                                    <span class="player-pawn" id="player1-{{$game_items->user1_item}}"></span>
                                @endif
                                @if($game_items->user2_item && ($game->user2_field == $properties[$i]->id))
                                    <span class="player-pawn" id="player2-{{$game_items->user2_item}}"></span>
                                @endif
                                @if($game_items->user3_item)
                                    @if($game->user3_field == $properties[$i]->id)
                                        <span class="player-pawn" id="player3-{{$game_items->user3_item}}"></span>
                                    @endif
                                @endif
                                @if($game_items->user4_item )
                                    @if($game->user4_field == $properties[$i]->id)
                                        <span class="player-pawn" id="player4-{{$game_items->user4_item}}"></span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- Центр поля --}}
                <div class="square9">
                    <div class="logoBox">
                        <span class="logoName">MonoPoly</span>
                    </div>
                </div>
                {{------------------}}

                <div class="square2">
                    @for($i = 31; $i < 40; $i++)
                        <div class="squareSide rightSide {{$properties[$i]->family}}">
                            @if($properties[$i]->type == 'field')
                                <div
                                    class="headerSide header-right white @if($live_properties[$i]->user_id) user{{$live_properties[$i]->user_id}} @endif"></div>
                            @endif
                            <div
                                class="firstLine firstLine-right {{$properties[$i]->type}} rotation1">
                                <b>{{$properties[$i]->name}}</b> @if($properties[$i]->type == 'field' && !$live_properties[$i]->rent)
                                    <br>{{$live_properties[$i]->price}}$ @elseif($live_properties[$i]->rent) <br>
                                    Оренда: {{$live_properties[$i]->rent}}$ @endif </div>
                            <div class="player-tokens rightSide">
                                @if($game_items->user1_item && ($game->user1_field == $properties[$i]->id))
                                    <span class="player-pawn" id="player1-{{$game_items->user1_item}}"></span>
                                @endif
                                @if($game_items->user2_item && ($game->user2_field == $properties[$i]->id))
                                    <span class="player-pawn" id="player2-{{$game_items->user2_item}}"></span>
                                @endif
                                @if($game_items->user3_item)
                                    @if($game->user3_field == $properties[$i]->id)
                                        <span class="player-pawn" id="player3-{{$game_items->user3_item}}"></span>
                                    @endif
                                @endif
                                @if($game_items->user4_item )
                                    @if($game->user4_field == $properties[$i]->id)
                                        <span class="player-pawn" id="player4-{{$game_items->user4_item}}"></span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="row-game top-game">
                @for($i = 10; $i >= 0; $i--)
                    <div
                        class="@if($properties[$i]->type == 'corner')square2 @else square1 @endif bottomSide {{$properties[$i]->family}}">
                        @if($properties[$i]->type == 'corner')
                            <span class="corner corner{{$properties[$i]->id}}">{{$properties[$i]->name}}</span>
                        @else
                            @if($properties[$i]->type == 'field')
                                <div
                                    class="header-game header-bottom white @if($live_properties[$i]->user_id) user{{$live_properties[$i]->user_id}} @endif"></div>
                            @endif
                            <div
                                class="firstLine firstLine-bottom rotation2">
                                <b>{{$properties[$i]->name}}</b> @if($properties[$i]->type == 'field' && $live_properties[$i]->rent)
                                    <br>Оренда:<br> {{$live_properties[$i]->rent}}
                                    $@elseif($properties[$i]->type == 'field') <br>
                                    {{$live_properties[$i]->price}}$ @endif </div>
                        @endif
                        <div class="player-tokens bottomSide">
                            @if($game_items->user1_item && ($game->user1_field == $properties[$i]->id))
                                <span class="player-pawn" id="player1-{{$game_items->user1_item}}"></span>
                            @endif
                            @if($game_items->user2_item && ($game->user2_field == $properties[$i]->id))
                                <span class="player-pawn" id="player2-{{$game_items->user2_item}}"></span>
                            @endif
                            @if($game_items->user3_item)
                                @if($game->user3_field == $properties[$i]->id)
                                    <span class="player-pawn" id="player3-{{$game_items->user3_item}}"></span>
                                @endif
                            @endif
                            @if($game_items->user4_item )
                                @if($game->user4_field == $properties[$i]->id)
                                    <span class="player-pawn" id="player4-{{$game_items->user4_item}}"></span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
