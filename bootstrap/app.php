<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix:'apicosmos'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
//        $exceptions->render(function (Exception $e){
//            dd($e);
//        });
        $exceptions->render(function (RouteNotFoundException $e){
            return response()->json([
                "code"=>401,
                "message"=>"Login failed"
            ],401);
        });
        $exceptions->render(function (NotFoundHttpException $e){
            return response()->json([
                "message"=>"Not found",
                "code"=>404,
            ],404);
        });
        $exceptions->render(function (AccessDeniedHttpException $e){
            return response()->json([
                "code"=>403,
                "message"=>"Forbidden for you"
            ],403);
        });
        $exceptions->render(function (ValidationException $e){
            return response()->json([
                'error'=>[
                    'code'=>422,
                    'message'=>'Validation error',
                    'errors'=>$e->validator->errors(),
                ]
            ],403);
        });
        $exceptions->render(function (AuthenticationException $e){
            return response()->json([
                "code"=>401,
                "message"=>"Login failed"
            ],401);
        });
    })->create();
