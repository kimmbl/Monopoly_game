<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $chance)
 * @method static find()
 */
class Chances extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'amount',
        'type',
    ];
}
