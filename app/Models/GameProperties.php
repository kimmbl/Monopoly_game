<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where()
 * @method static join()
 */
class GameProperties extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'game_id',
        'price',
        'rent'
    ];

    public function lobby(){
        return $this->belongsTo(Lobby::class, 'game_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function property(){
        return $this->belongsTo(Properties::class);
    }
}
