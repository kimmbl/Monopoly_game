<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 * @method static create()
 */
class Inventory extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'item_id',
        'is_chosen_dice',
        'is_chosen_pawn'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function item(){
        return $this->belongsTo(Items::class);
    }
}
