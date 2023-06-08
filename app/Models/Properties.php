<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $property)
 * @method static select()
 * @method static get()
 * @method static find(\App\Http\Livewire\Game $param)
 */
class Properties extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'name',
        'type',
        'family',
    ];

    public function game_properties(){
        return $this->hasMany(GameProperties::class, 'property_id');
    }
}
