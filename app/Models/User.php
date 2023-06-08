<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find()
 * @method static where()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    protected $guarded = [
        'is_muted',
        'is_admin',
        'is_moderator'
    ];

    protected $attributes = [
        'is_muted' => false,
        'is_admin' => false,
        'is_moderator' => false,
        'is_banned' => false,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function friend(){
        return $this->hasMany(Friends::class);
    }

    public function is_friend(){
        return $this->hasMany(Friends::class, 'friend_id');
    }

    public function stats(){
        return $this->hasOne(Stats::class);
    }

    public function lobby_slot1(){
        return $this->hasMany(Lobby::class, 'user1_id');
    }

    public function lobby_slot2(){
        return $this->hasMany(Lobby::class, 'user2_id');
    }

    public function lobby_slot3(){
        return $this->hasMany(Lobby::class, 'user3_id');
    }

    public function lobby_slot4(){
        return $this->hasMany(Lobby::class, 'user4_id');
    }

    public function winner(){
        return $this->hasMany(Lobby::class, 'winner_id');
    }

    public function user_money(){
        return $this->hasMany(GameMoney::class);
    }

    public function user_property(){
        return $this->hasMany(GameMoney::class);
    }
}
