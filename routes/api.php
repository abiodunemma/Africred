<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\ReviewController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::get("movies", [AuthController::class, "movie"]);

Route::middleware("auth:api")->group(function(){
    Route::apiResource("movies", MovieController::class);
    Route::apiResource("reviews", ReviewController::class);
});

// Route::middleware("auth:api")->group(function(){
//     Route::apiResource("reviews", ReviewController::class);
// });


