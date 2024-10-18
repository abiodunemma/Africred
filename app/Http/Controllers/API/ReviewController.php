<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\Review;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function free(Request $request){
        $reviews = Review::paginate(5);

        return response()->json([
            "status" => 1,
            "message" => "review output",
            "data" => $reviews
        ]);
    }

    public function index(Request $request){
        $reviews = Review::paginate(5);

        return response()->json([
            "status" => 1,
            "message" => "review output",
            "data" => $reviews
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
         "user_id" => "required|exists:users,id",
         "movie_id" => "required|exists:movies,id",
          'ratings' => 'required|integer|min:1|max:5',
            //"ratings" =>"required|max:5",
            "comments" => "required",


        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "validation error",
                "data" => $validator->errors()->all()
            ]);
        }



        $reviews = Review::create([
            "user_id" => $request->user_id, // Include user_id,
            "movie_id" => $request->movie_id,
            "ratings" => $request->ratings,
            "comments" => $request->comments, // Store the path of the uploaded file


        ]);
        return response()->json([
            "status" => 1,
            "message" => "view inputed Successfully",
            "data" => $reviews
        ]);

    }


}
