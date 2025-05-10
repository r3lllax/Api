<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GagarinController;
use App\Http\Controllers\LunarMissionController;
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

    Route::post("/lunar-missions",[LunarMissionController::class,'store']);

    Route::patch("/lunar-missions/{mission}",[LunarMissionController::class,'update'])->can('manage,mission');
    Route::delete("/lunar-missions/{mission}",[LunarMissionController::class,'delete'])->can('manage,mission');
});

