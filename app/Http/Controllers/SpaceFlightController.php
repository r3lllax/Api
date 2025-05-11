<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceFlightRequest;
use App\Models\SpaceFlight;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SpaceFlightController extends Controller
{
    /**
     * Create space flight
     * @param SpaceFlightRequest $request
     * @return JsonResponseAlias
     */
    public function store(SpaceFlightRequest $request)
    {
        SpaceFlight::query()->create($request->validated());
        return response()->json([
            "data"=>[
                'code'=>201,
                'message'=>'Космический полет создан',
            ]
        ],201);
    }

    /**
     * @return Collection
     */
    public function index()
    {
        $response =  SpaceFlight::query()->select('flight_number','destination','launch_date','seats_available')->get();
    }


    /**
     * @return JsonResponseAlias
     */
    public function book()
    {
        $flightNumber = \request()->input('flight_number');
        $spaceFlight = SpaceFlight::query()->where('flight_number',$flightNumber)->first();
        if(!$spaceFlight){
            throw new NotFoundHttpException();
        }

        if($spaceFlight->books()->count()>=$spaceFlight->seats_available){
            throw new AccessDeniedHttpException();
        }

        $spaceFlight->books()->create([
            'user_id'=>auth()->user()->id
        ]);
        return response()->json([
            'data'=>[
                'code'=>201,
                'message'=>"Рейс забронирован",
            ]
        ],201);
    }
}
