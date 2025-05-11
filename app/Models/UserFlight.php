<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $flight_id
 * @property int $user_id
 */
class UserFlight extends Model
{
    protected $fillable =[
        'flight_id',
        'user_id'
    ];
}
