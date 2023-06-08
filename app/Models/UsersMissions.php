<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create()
 * @method static where()
 */
class UsersMissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mission_id',
        'actual',
    ];

    protected $attributes = [
        'is_done' => false,
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function missions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Missions::class, 'mission_id');
    }
}
