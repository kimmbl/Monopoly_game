<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where()
 * @method static find()
 * @method static select()
 */
class Stats extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'games_played',
        'games_won',
        'missions_completed',
        'friends_added',
        'messages_sent',
        'banned_times',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
