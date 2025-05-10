<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *@property int $id
 *@property string $name
 *@property int $user_id
 *@property array $launch_details
 *@property array $landing_details
 *@property array $spacecraft
 *
 */

class LunarMission extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'launch_details',
        'landing_details',
        'spacecraft',
    ];
    protected $casts = [
        'launch_details'=>'json',
        'landing_details'=>'json',
        'spacecraft'=>'json',
    ];

    /**
     * Get user author
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Author()
    {
        return $this->hasOne(User::class,'id','user_id');
    }



}
