<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 */
class GameChat extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id', 'lobby_id'];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lobby(){
        return $this->belongsTo(Lobby::class);
    }
}
