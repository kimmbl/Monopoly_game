<?php

namespace App\Http\Livewire;

use App\Models\Chances;
use App\Models\GameChat as Chat;
use App\Models\GameItems;
use App\Models\GameMoney;
use App\Models\GameProperties;
use App\Models\Games;
use App\Models\Lobby;
use App\Models\Properties;
use App\Models\Stats;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Game extends Component
{
    public $lobby_id;
    public $lobby, $game_money;
    public $live_properties, $properties, $game_items, $game;
    public $user_id, $messageText, $messages;

    public $field, $player;
    public $doubles = 0;

    public $houseBought = 0;

    public function refresh()
    {
        $this->lobby = Lobby::with('user1')
            ->with('user2')
            ->with('user3')
            ->with('user4')
            ->find($this->lobby_id);

        $this->game_money = GameMoney::where('game_id', $this->lobby_id)->first();


        $this->live_properties = GameProperties::where('game_id', $this->lobby_id)->get();
        $this->game_items = GameItems::where('game_id', $this->lobby_id)->first();
        $this->game = Games::where('game_id', $this->lobby_id)->first();

        $this->messages = Chat::with('user')
            ->where('lobby_id', $this->lobby_id)
            ->latest()
            ->get()
            ->sortBy('id');
    }

    public function sendMessage()
    {
        if ($this->messageText) {
            Chat::create([
                'user_id' => Auth::id(),
                'message' => $this->messageText,
                'lobby_id' => $this->lobby_id
            ]);

            $this->reset('messageText');
            return view('livewire.game');
        }
    }

    public function startGame()
    {
        $this->lobby->is_started = 1;
        $this->lobby->save();

        Games::where('game_id', $this->lobby_id)
            ->update(['active_user_id' => Auth::id(), 'active_action' => 'dice_throwing', 'active_player' => 1]);

        return view('livewire.game');
    }

    public function throwDice()
    {
        $this->houseBought = 1;
        $dice1 = mt_rand(1, 6);
        $dice2 = mt_rand(1, 6);

        if ($dice1 == $dice2 && $this->doubles == 2) {
            $this->checkDoubles();
            return view('livewire.game');
        }

        switch ($this->game->active_player) {
            case(1):
                if ($this->game->user1_field == 11 && $this->game->prison_user1 < 4 && $this->game->prison_user1 > 0 && $dice1 != $dice2) {
                    $this->createSystemMessage(Auth::user()->name . ' стоїть у черзі в ЦНАП.');
                    $this->game->active_action = 'end_turn';
                    $this->game->prison_user1++;
                    $this->game->save();
                    $this->createSystemMessage(Auth::user()->name . ' викинув ' . $dice1 . ' і ' . $dice2 . ', стоїть у черзі в ЦНАП.');
                    return view('livewire.game');
                } else {
                    $this->game->user1_field += $dice1 + $dice2;
                    if ($this->game->user1_field > 40) {
                        $this->game->user1_field -= 40;
                        $this->game_money->user1_money += 200;
                    }
                    $this->field = $this->game->user1_field;
                }
                break;
            case(2):
                if ($this->game->user2_field == 11 && $this->game->prison_user2 < 4 && $this->game->prison_user2 > 0 && $dice1 != $dice2) {
                    $this->createSystemMessage(Auth::user()->name . ' стоїть у черзі в ЦНАП.');
                    $this->game->active_action = 'end_turn';
                    $this->game->prison_user2++;
                    $this->game->save();
                    return view('livewire.game');
                } else {
                    $this->game->user2_field += $dice1 + $dice2;
                    if ($this->game->user2_field > 40) {
                        $this->game->user2_field -= 40;
                        $this->game_money->user2_money += 200;
                    }

                    $this->field = $this->game->user2_field;
                }
                break;
            case(3):
                if ($this->game->user3_field == 11 && $this->game->prison_user3 < 4 && $this->game->prison_user3 > 0 && $dice1 != $dice2) {
                    $this->createSystemMessage(Auth::user()->name . ' стоїть у черзі в ЦНАП.');
                    $this->game->active_action = 'end_turn';
                    $this->game->prison_user3++;
                    $this->game->save();
                    return view('livewire.game');
                } else {
                    $this->game->user3_field += $dice1 + $dice2;
                    if ($this->game->user3_field > 40) {
                        $this->game->user3_field -= 40;
                        $this->game_money->user3_money += 200;
                    }

                    $this->field = $this->game->user3_field;
                }
                break;
            case(4):
                if ($this->game->user4_field == 11 && $this->game->prison_user4 < 4 && $this->game->prison_user4 > 0 && $dice1 != $dice2) {
                    $this->createSystemMessage(Auth::user()->name . ' стоїть у черзі в ЦНАП.');
                    $this->game->active_action = 'end_turn';
                    $this->game->prison_user4++;
                    $this->game->save();
                    return view('livewire.game');
                } else {
                    $this->game->user4_field += $dice1 + $dice2;
                    if ($this->game->user4_field > 40) {
                        $this->game->user4_field -= 40;
                        $this->game_money->user4_money += 200;
                    }

                    $this->field = $this->game->user4_field;
                }
                break;
            default:
                break;
        }

        $this->game->first_dice = $dice1;
        $this->game->second_dice = $dice2;
        $this->game_money->save();


        $property = GameProperties::join('properties', 'game_properties.property_id', '=', 'properties.id')
            ->where('game_id', $this->lobby_id)
            ->where('property_id', $this->field)
            ->select('user_id', 'game_properties.rent', 'game_properties.price', 'family', 'type', 'name', 'full_name')
            ->first();

        if ($property->full_name)
            $name = $property->full_name;
        else
            $name = $property->name;

        $this->createSystemMessage(Auth::user()->name . ' викинув(-ла) ' . $dice1 . ' і ' . $dice2 . '. Іде на поле "' . $name . '".');

        $this->game->save();

        switch ($property->type) {
            case('field'):
                if (!$property->rent) {
                    $this->game->active_action = 'buy_or_decline';
                } elseif ($this->game->active_player == $property->user_id) {
                    $this->checkDoubles();
                } else {
                    if ($property->family == 'webpage')
                        $this->game->must_pay = $property->rent * ($dice1 + $dice2);
                    else
                        $this->game->must_pay = $property->rent;
                    $this->game->active_action = 'must_pay';
                }
                break;
            case('fine'):
                $this->game->must_pay = $property->price;
                $this->game->active_action = 'must_pay_fine';
                break;
            case('corner'):
                if ($property->family == 'start' || $property->family == 'prison' || $property->family == 'free') {
                    $this->checkDoubles();
                } elseif ($property->family == 'go_to_prison') {
                    $this->changePlace(11, true);
                    $this->game->active_action = 'end_turn';
                }
                break;
            case('chance'):
                $chance = Chances::find(mt_rand(1, 15));
                $this->createSystemMessage(Auth::user()->name . $chance->text);
                if ($chance->type == 'go') {
                    $this->changePlace($chance->goto);
                    if ($this->field < $chance->goto)
                        $this->changeMoney($chance->amount, '+');

                    $this->field = $chance->goto;
                    $property = GameProperties::join('properties', 'game_properties.property_id', '=', 'properties.id')
                        ->where('game_id', $this->lobby_id)
                        ->where('property_id', $this->field)
                        ->select('user_id', 'game_properties.rent', 'game_properties.price', 'family', 'type', 'name')
                        ->first();

                    if (!$property->rent) {
                        $this->game->active_action = 'buy_or_decline';
                    } elseif ($this->game->active_player == $property->user_id) {
                        $this->checkDoubles();
                    } else {
                        if ($property->family == 'webpage')
                            $this->game->must_pay = $property->rent * ($dice1 + $dice2);
                        else
                            $this->game->must_pay = $property->rent;
                        $this->game->active_action = 'must_pay';
                    }

                } elseif ($chance->type == 'gain') {
                    $this->changeMoney($chance->amount, '+');
                    $this->checkDoubles();
                } elseif ($chance->type == 'ticket') {
                    $this->game->must_pay = $chance->amount;
                    $this->game->active_action = 'must_pay_fine';
                } elseif ($chance->type == 'prison') {
                    $this->changePlace(11, true);
                    $this->game->active_action = 'end_turn';
                }
                break;
            default:
                break;
        }

        $this->game->save();
        return view('livewire.game');
    }

    public function createSystemMessage($text)
    {
        Chat::create([
            'lobby_id' => $this->lobby_id,
            'user_id' => 1,
            'message' => $text
        ]);
    }

    public function changeMoney($money, $op)
    {
        switch ($op) {
            case('+'):
                if ($this->player == 1) {
                    $this->game_money->user1_money += $money;
                } elseif ($this->player == 2) {
                    $this->game_money->user2_money += $money;
                } elseif ($this->player == 2) {
                    $this->game_money->user3_money += $money;
                } elseif ($this->player == 4) {
                    $this->game_money->user4_money += $money;
                }
                break;
            case('-'):
                if ($this->player == 1) {
                    $this->game_money->user1_money -= $money;
                } elseif ($this->player == 2) {
                    $this->game_money->user2_money -= $money;
                } elseif ($this->player == 2) {
                    $this->game_money->user3_money -= $money;
                } elseif ($this->player == 4) {
                    $this->game_money->user4_money -= $money;
                }
                break;
            default:
                break;
        }
        $this->game_money->save();
    }

    public function checkMoney($money)
    {
        if ($this->player == 1) {
            if($this->game_money->user1_money < $money)
                return false;
            else
                return true;
        } elseif ($this->player == 2) {
            if($this->game_money->user2_money < $money)
                return false;
            else
                return true;
        } elseif ($this->player == 2) {
            if($this->game_money->user3_money < $money)
                return false;
            else
                return true;
        } elseif ($this->player == 4) {
            if($this->game_money->user4_money < $money)
                return false;
            else
                return true;
        }
    }

    public function changePlace($place, $prison = false)
    {
        if ($this->player == 1) {
            $this->game->user1_field = $place;
            if ($prison)
                $this->game->prison_user1 = 1;
        } elseif ($this->player == 2) {
            $this->game->user2_field = $place;
            if ($prison)
                $this->game->prison_user2 = 1;
        } elseif ($this->player == 2) {
            $this->game->user3_field = $place;
            if ($prison)
                $this->game->prison_user3 = 1;
        } elseif ($this->player == 4) {
            $this->game->user4_field = $place;
            if ($prison)
                $this->game->prison_user4 = 1;
        }
        $this->game->save();
    }


    public function buyCell()
    {
        $property = GameProperties::where('game_id', $this->lobby_id)
            ->where('property_id', $this->field)
            ->first();

        if($this->checkMoney($property->price)){

            $this->changeMoney($property->price, '-');


            $this->game_money->save();

            if ($this->properties[$this->field - 1]->family == 'science') {
                $arr = array($this->live_properties[5]->user_id, $this->live_properties[15]->user_id, $this->live_properties[25]->user_id, $this->live_properties[35]->user_id);
                $tmp = array_keys($arr, $this->player);

                if (count($tmp) == 0) {
                    $property->rent = 25;
                } elseif (count($tmp) == 1) {
                    $property->rent = 50;
                    GameProperties::join('properties', 'game_properties.property_id', '=', 'properties.id')
                        ->where('game_id', $this->lobby_id)
                        ->where('user_id', $this->player)
                        ->where('family', 'science')
                        ->update(['game_properties.rent' => 50]);
                } elseif (count($tmp) == 2) {
                    $property->rent = 100;
                    GameProperties::join('properties', 'game_properties.property_id', '=', 'properties.id')
                        ->where('game_id', $this->lobby_id)
                        ->where('user_id', $this->player)
                        ->where('family', 'science')
                        ->update(['game_properties.rent' => 100]);
                } elseif (count($tmp) == 3) {
                    $property->rent = 200;
                    GameProperties::join('properties', 'game_properties.property_id', '=', 'properties.id')
                        ->where('game_id', $this->lobby_id)
                        ->where('user_id', $this->player)
                        ->where('family', 'science')
                        ->update(['game_properties.rent' => 200]);
                }
            } elseif ($this->properties[$this->field - 1]->family == 'webpage') {
                $arr = array($this->live_properties[12]->user_id, $this->live_properties[28]->user_id);
                $tmp = array_keys($arr, $this->player);

                if (count($tmp) == 0) {
                    $property->rent = 4;
                } elseif (count($tmp) == 1) {
                    GameProperties::where('game_id', $this->lobby_id)
                        ->where(function ($query) {
                            $query->where('property_id', 13)
                                ->orWhere('property_id', 29);
                        })
                        ->update(['rent' => 10]);
                }
            } else {
                $property->rent = $this->properties[$this->field - 1]->rent;
            }
            $property->user_id = $this->player;
            $property->save();

            $this->checkDoubles();
        } else {
            $this->emit('not_enough_money');
        }
        return view('livewire.game');
    }

    public function payFine()
    {
        if($this->checkMoney($this->game->must_pay)) {
            $this->changeMoney($this->game->must_pay, '-');

            if ($this->game->active_action = 'must_pay') {
                $temp = $this->player;
                $this->player = $this->live_properties[$this->field - 1]->user_id;
                $this->changeMoney($this->game->must_pay, '+');
                $this->player = $temp;
            }

            $this->game_money->save();

            $this->game->must_pay = 0;
            $this->game->save();

            $this->checkDoubles();
        } else {
            $this->emit('not_enough_money');
        }
        return view('livewire.game');
    }

    public function buyHouse($id)
    {
        if($this->checkMoney($this->properties[$id - 1]->buyHouse)) {
            $family = $this->properties[$id - 1]->family;
            $sum = 0;

            for ($k = 0; $k < 40; $k++) {
                if ($this->properties[$k]->family == $family) {
                    if ($this->live_properties[$k]->user_id == $this->player) {
                        $sum++;
                    }
                }
            }


            if (($family == 'prints' || $family == 'festival') && $sum == 2 || $sum == 3) {
                if (!$this->houseBought) {
                    $houses = $this->live_properties[$id - 1]->house;
                    if ($houses == 0) {
                        $rent = $this->properties[$id - 1]->house1;
                    } elseif ($houses == 1) {
                        $rent = $this->properties[$id - 1]->house2;
                    } elseif ($houses == 2) {
                        $rent = $this->properties[$id - 1]->house3;
                    } elseif ($houses == 3) {
                        $rent = $this->properties[$id - 1]->house4;
                    } elseif ($houses == 4) {
                        $rent = $this->properties[$id - 1]->star;
                    } else {
                        $this->emit('maxHouses');
                        return view('livewire.game');
                    }


                    GameProperties::where('property_id', $id)
                        ->where('game_id', $this->lobby_id)
                        ->update([
                            'house' => DB::raw('house+1'),
                            'rent' => $rent
                        ]);

                    $this->changeMoney($this->properties[$id - 1]->buyHouse, '-');

                    $this->houseBought = 1;
                } else
                    $this->emit('bought');
            } else {
                $this->emit('not_enough_fields');
            }
        } else {
            $this->emit('not_enougth_money');
        }
        return view('livewire.game');
    }

    public function sellHouse($id)
    {
        if ($this->live_properties[$id - 1]->house > 0) {
            $houses = $this->live_properties[$id - 1]->house - 1;
            $money = intval($this->properties[$id - 1]->buy_house / 2);

            $this->changeMoney($money, '+');

            if ($houses == 0) {
                $rent = $this->properties[$id - 1]->rent;
            } elseif ($houses == 1) {
                $rent = $this->properties[$id - 1]->house1;
            } elseif ($houses == 2) {
                $rent = $this->properties[$id - 1]->house2;
            } elseif ($houses == 3) {
                $rent = $this->properties[$id - 1]->house3;
            } elseif ($houses == 4) {
                $rent = $this->properties[$id - 1]->house4;
            } else {
                $rent = $this->properties[$id - 1]->rent;
            }
            GameProperties::where('property_id', $id)
                ->where('game_id', $this->lobby_id)
                ->update([
                    'house' => DB::raw('house-1'),
                    'rent' => $rent
                ]);

        } else {
            $family = $this->properties[$id - 1]->family;
            $sum = 0;

            for ($k = 0; $k < 40; $k++) {
                if ($this->properties[$k]->family == $family) {
                    if ($this->live_properties[$k]->house > 0) {
                        $sum++;
                        break;
                    }
                }
            }

            if ($sum > 0) {
                $this->emit('cant_sold_this');
                return view('livewire.game');
            } else {
                if ($family == 'webpage') {
                    GameProperties::join('properties', 'properties.id', '=', 'game_properties.property_id')
                        ->where('properties.family', $family)
                        ->where('user_id', Auth::id())
                        ->where('game_id', $this->lobby_id)
                        ->update(['game_properties.rent' => 4]);
                } elseif ($family == 'science') {
                    GameProperties::join('properties', 'properties.id', '=', 'game_properties.property_id')
                        ->where('properties.family', $family)
                        ->where('user_id', $this->player)
                        ->where('game_id', $this->lobby_id)
                        ->update(['game_properties.rent' => DB::raw('game_properties.rent/2')]);
                }
                GameProperties::where('property_id', $id)
                    ->where('game_id', $this->lobby_id)
                    ->update(['rent' => null, 'user_id' => null]);

                $money = intval($this->properties[$id - 1]->price / 2);

                $this->changeMoney($money, '+');
                $this->createSystemMessage('Поле ' . $this->properties[$id - 1]->name . ' було продано банку.');
            }
        }

        return view('livewire.game');
    }

    public function checkDoubles()
    {
        if ($this->game->first_dice == $this->game->second_dice && $this->doubles < 2) {
            $this->doubles++;
            $this->game->active_action = 'dice_throwing';
            $this->houseBought = 0;
            $this->createSystemMessage(Auth::user()->name . ' викинув дубль. Він кидає знову.');
        } elseif ($this->game->first_dice == $this->game->second_dice) {
            $this->changePlace(11, true);
            $this->doubles = 0;
            $this->game->active_action = 'end_turn';
            $this->createSystemMessage(Auth::user()->name . ' викинув дубль втретє. Іде в чергу до ЦНАПу.');
        } else {
            $this->game->active_action = 'end_turn';
            $this->doubles = 0;
            $this->game_money->save();
        }
        $this->game->save();
        return view('livewire.game');
    }

    // poddanie się
    public function surrender()
    {
        switch ($this->player) {
            case('1'):
                $this->game->user1_field = null;
                $this->game_money->user1_money = 0;
                break;
            case('2'):
                $this->game->user2_field = null;
                $this->game_money->user2_money = 0;
                break;
            case('3'):
                $this->game->user3_field = null;
                $this->game_money->user3_money = 0;
                break;
            case('4'):
                $this->game->user4_field = null;
                $this->game_money->user4_money = 0;
                break;
            default:
                break;
        }

        $this->game->save();

        GameProperties::where('user_id', $this->player)
            ->update([
                'rent' => null,
                'user_id' => null
            ]);

        if ($this->game->active_player == $this->player) {
            if ($this->game->active_action == 'must_pay') {
                $temp = $this->player;
                $this->player = $this->live_properties[$this->field - 1]->user_id;
                $this->changeMoney($this->game->must_pay, '+');
                $this->player = $temp;
            }
            $this->endTurn(true);
        }

        return view('livewire.game');
    }

    //відмова від покупки
    public function declineBuying()
    {
        $this->checkDoubles();
    }

    //функція закінчення ходу
    public function endTurn($surr = false)
    {
        $fields = [$this->game->user1_field, $this->game->user2_field,
            $this->game->user3_field, $this->game->user4_field];


        $players = [$this->lobby->user1_id, $this->lobby->user2_id,
            $this->lobby->user3_id, $this->lobby->user4_id];

        if ($surr) {
            $sum = 0;
            $winner = 0;
            for ($i = 0; $i < 4; $i++) {
                if ($fields[$i] == null)
                    $sum++;
                else
                    $winner = $players[$i];
            }
            if ($sum >= 3) {
                $this->game->active_action = 'end_game';
                $this->lobby->is_ended = 1;
                $this->lobby->winner_id = $winner;

                Stats::where('user_id', $this->lobby->winner_id)
                    ->increment('games_won', 1);


                for ($i = 0; $i < 4; $i++) {
                    if ($players[$i] != null)
                        Stats::where('user_id', $players[$i])
                            ->increment('games_played', 1);
                }

                $this->lobby->save();
                $this->game->save();

                $this->createSystemMessage(Auth::user()->name . ' здався.');
                return view('livewire.game');
            }
        }

        $arr_player = $this->player;
        $temp = 0;
        $next_player = null;

        while ($temp < 3) {
            if ($arr_player > 3)
                $arr_player = 0;
            if ($fields[$arr_player] && $fields[$arr_player] != 0) {
                $next_player = $players[$arr_player];
                break;
            } else
                $temp++;
            $arr_player++;
        }

        if (!$next_player) {
            $this->game->active_action = 'winner';
        } else {
            $this->game->active_action = 'dice_throwing';
            $this->game->active_player = $arr_player + 1;
            $this->game->active_user_id = $next_player;
        }
        $this->game->save();

        return view('livewire.game');
    }

    public function render()
    {
        $this->lobby = Lobby::with('user1')
            ->with('user2')
            ->with('user3')
            ->with('user4')
            ->find($this->lobby_id);

        $this->game_money = GameMoney::where('game_id', $this->lobby_id)->first();
        $this->live_properties = GameProperties::where('game_id', $this->lobby_id)->get();
        $this->properties = Properties::get();
        $this->game_items = GameItems::where('game_id', $this->lobby_id)->first();
        $this->game = Games::where('game_id', $this->lobby_id)->first();

        if (Auth::id() == $this->lobby->user1_id) {
            $this->field = $this->game->user1_field;
            $this->player = 1;
        } elseif (Auth::id() == $this->lobby->user2_id) {
            $this->field = $this->game->user2_field;
            $this->player = 2;
        } elseif (Auth::id() == $this->lobby->user3_id) {
            $this->field = $this->game->user3_field;
            $this->player = 3;
        } elseif (Auth::id() == $this->lobby->user4_id) {
            $this->field = $this->game->user4_field;
            $this->player = 4;
        }

        $this->messages = Chat::with('user')
            ->where('lobby_id', $this->lobby_id)
            ->latest()
            ->get()
            ->sortBy('id');
        return view('livewire.game');
    }
}
