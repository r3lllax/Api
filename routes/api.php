<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GagarinController;
use App\Http\Controllers\LunarMissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/registration",[AuthController::class,'registration']);
Route::post("/authorization",[AuthController::class,'authorization']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get("/logout",[AuthController::class,'logout']);
    Route::post("/lunar-missions",[LunarMissionController::class,'store']);
});
Route::get("/gagarin-flight", GagarinController::class);
