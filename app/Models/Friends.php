<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 * @method static join()
 * @property int|mixed|string|null user_id
 * @property mixed friend_id
 */
class Friends extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function friend(){
        return $this->belongsTo(User::class, 'friend_id');
    }
}
