<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::post('/login',[AuthController::class,'login']);
// Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthSessionController::class,'login']);
Route::post('/register',[AuthSessionController::class,'register']);


Route::group(['middleware'=>'auth:sanctum'],function(){
    // Route::post('logout',[AuthController::class,'logout']);
    Route::post('logout',[AuthSessionController::class,'logout']);
    Route::get('/user', function (Request $request) {return $request->user();});
});

