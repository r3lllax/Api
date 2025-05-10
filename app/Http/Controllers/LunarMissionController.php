<?php

namespace App\Http\Controllers;

use App\Http\Requests\LunarMissionRequest;
use App\Http\Requests\OneMissionRequest;
use App\Http\Resources\LunarMissionResource;
use App\Http\Resources\SearchMissionsResource;
use App\Models\LunarMission;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use function Pest\Laravel\json;

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

    /**
     * @param LunarMission $mission
     * @return LunarMissionResource
     */
    public function show(LunarMission $mission)
    {
        return LunarMissionResource::make($mission);
    }

    /**
     * @param LunarMission $mission
     * @return \Illuminate\Http\Response
     */
    public function delete(LunarMission $mission)
    {

        $mission->delete();
        return response()->noContent();
    }

    /**
     * @param LunarMission $mission
     * @param LunarMissionRequest $request
     * @return array[]
     */
    public function update(LunarMission $mission,LunarMissionRequest $request)
    {
        $mission->update($request->validated()['mission']);
        return [
            'data'=>[
                'code'=>200,
                'message'=>'Миссия обновлена'
            ]
        ];

    }

    /**
     * @return AnonymousResourceCollection
     */
    public function search()
    {
        $query = request()->input('query','');

        return SearchMissionsResource::collection(LunarMission::query()
            ->where('name','like','%' . $query . '%')
            ->orWhereJsonContains('spacecraft->crew',[['name'=>$query]])
            ->get());
    }
}
