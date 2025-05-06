<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class AuthController extends Controller
{

    /**
     * Registration
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request)
    {
        /** @var User $user */
        $user = User::query()->create($request->validated());
        return response()->json([
            'data'=>[
                'user'=>[
                    'name'=>$user->fullName(),
                    'email'=>$user->email,
                ],
                'code'=>201,
                'message'=>"Created"
            ],
        ],201);

    }

    /**
     * Authorization
     * @param AuthRequest $request
     * @return JsonResponse|array
     */
    public function authorization(AuthRequest $request)
    {
        if(auth()->attempt($request->validated())){
            /** @var User $user */
            $user = auth()->user();
            return response()->json([
                'data'=>[
                    'user'=>[
                        'id'=>$user->id,
                        'name'=>$user->fullName(),
                        'birth_date'=>$user->birth_date,
                        'email'=>$user->email,
                    ]
                ],
                'token'=>$user->createToken('api')->plainTextToken,
            ]);
        }

        return response()->json([
            'code'=>401,
            'message'=>'Login failed',
        ],401);
    }

    /**
     * @return Response
     */

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
