<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GagarinController;
use App\Http\Controllers\LunarMissionController;
use App\Http\Controllers\SpaceFlightController;
use App\Http\Controllers\Watermark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/registration",[AuthController::class,'registration']);
Route::post("/authorization",[AuthController::class,'authorization']);

Route::get("/gagarin-flight", GagarinController::class);
Route::get("/search",[LunarMissionController::class,'search']);
Route::get("/lunar-missions",[LunarMissionController::class,'index']);
Route::get("/lunar-missions/{mission}",[LunarMissionController::class,'show']);



Route::middleware('auth:sanctum')->group(function (){
    Route::get("/logout",[AuthController::class,'logout']);
    Route::post("/space-flights",[SpaceFlightController::class,'store']);
    Route::get("/space-flights",[SpaceFlightController::class,'index']);
    Route::post("/book-flight",[SpaceFlightController::class,'book']);

    Route::post("/lunar-missions",[LunarMissionController::class,'store']);
    Route::post("/lunar-watermark",Watermark::class);

    Route::patch("/lunar-missions/{mission}",[LunarMissionController::class,'update'])->can('manage,mission');
    Route::delete("/lunar-missions/{mission}",[LunarMissionController::class,'delete'])->can('manage,mission');
});

