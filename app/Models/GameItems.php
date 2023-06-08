<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 * @method static find($lobby_id)
 * @method static where()
 */
class GameItems extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'user1_item',
        'user2_item',
        'user3_item',
        'user4_item'
    ];
}
