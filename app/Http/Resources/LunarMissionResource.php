<?php

namespace App\Http\Resources;

use App\Models\LunarMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin LunarMission
 */


class LunarMissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        self::wrap(false);
        return [
            'mission'=>[
                'name'=>$this->name,
                'launch_details'=>$this->launch_details,
                'landing_details'=>$this->landing_details,
                'spacecraft'=>$this->spacecraft,
            ],
        ];
    }
}
