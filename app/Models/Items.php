<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $item)
 */
class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'rarity',
        'img',
        'shortname',
    ];

    public function mission(){
        return $this->hasOne(Missions::class, 'item_id');
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'item_id');
    }


}
