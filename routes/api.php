<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\RatingController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

// Allow unauthorized access to fetch movies
Route::get('review', [ReviewController::class, 'free']);
Route::get('movie', [MovieController::class, 'free']);
Route::middleware('auth:api')->get('movies/search', [MovieController::class, 'search']);
Route::middleware("auth:api")->group(function(){
    Route::post('movies/{movie}/ratings', [RatingController::class, 'store']);
    Route::get('movies/{movie}/ratings', [RatingController::class, 'show']);

    Route::apiResource("movies", MovieController::class);
    Route::apiResource("reviews", ReviewController::class);
});

// Route::middleware("auth:api")->group(function(){
//     Route::apiResource("reviews", ReviewController::class);
// });


