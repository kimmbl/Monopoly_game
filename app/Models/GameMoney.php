<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 * @method static where(string $string, $id)
 */
class GameMoney extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'user1_money',
        'user2_money',
        'user3_money',
        'user4_money',
    ];

    public function lobby(){
        return $this->belongsTo(Lobby::class, 'game_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
