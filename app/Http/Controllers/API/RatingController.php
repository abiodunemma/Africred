<?php

namespace App\Http\Controllers\API;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, $movieId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::updateOrCreate(
            ['movie_id' => $movieId, 'user_id' => auth()->id()],
            ['rating' => $request->rating]
        );

        return response()->json($rating, 201);
    }

    public function show($movieId)
    {
        $movie = Movie::with('ratings')->findOrFail($movieId);
        return response()->json([
            'average_rating' => $movie->averageRating(),
            'ratings' => $movie->ratings,
        ]);
    }
}
