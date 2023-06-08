<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find()
 * @method static create()
 * @method static where(string $string, $lobby_id)
 */
class Games extends Model
{
    use HasFactory;

    protected $primaryKey = 'game_id';

    public $fillable = [
        'game_id',
        'user1_field',
        'user2_field',
        'user3_field',
        'user4_field',
        'active_user',
        'active_action',
        'must_pay',
        'prison_user1',
        'prison_user2',
        'prison_user3',
        'prison_user4',
        'first_dice',
        'second_dice'
    ];
}
