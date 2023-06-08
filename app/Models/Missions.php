<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 * @method static find(mixed $mission_id)
 * @method static where()
 */
class Missions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'goal',
        'description',
        'item_id',
    ];

    protected $attributes = [
        'hidden' => false,
    ];

    public function item(){
        return $this->belongsTo(Items::class);
    }

    public function user_mission(){
        return $this->hasMany(UsersMissions::class, 'mission_id');
    }
}
