<?php

namespace App\Http\Controllers;

use App\Http\Requests\LunarMissionRequest;
use App\Http\Resources\LunarMissionResource;
use App\Models\LunarMission;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LunarMissionController extends Controller
{

    /**
     * Get lunar missions
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return LunarMissionResource::collection(LunarMission::query()->get());
    }

    /**
     * @param LunarMissionRequest $request
     * @return JsonResponse
     */
    public function store(LunarMissionRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->lunarMissions()->create($request->validated()['mission']);
        return response()->json([
            "data"=>[
                "code"=>201,
                "message"=>"Миссия добавлена",
            ]
        ],201);
    }
}
