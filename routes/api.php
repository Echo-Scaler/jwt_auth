<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JWTMiddleware;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login',[AuthController::class,'login']);

// Route::middleware('auth:api')->group(function(){
//     Route::post('logout',[AuthController::class,'logout']);
//     Route::post('me',[AuthController::class,'me']);
// });

Route::middleware('jwt')->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
});
