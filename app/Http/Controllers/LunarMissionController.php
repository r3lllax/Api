<?php

namespace App\Http\Controllers;

use App\Http\Requests\LunarMissionRequest;
use App\Models\LunarMission;
use Illuminate\Http\Request;

class LunarMissionController extends Controller
{
    public function store(LunarMissionRequest $request)
    {
        $data = $request->validated()['mission'];

        $data['user_id']=auth()->user()->id;
        return LunarMission::query()->create($data);
    }
}
