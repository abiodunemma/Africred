<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\MovieResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\Movie;
 use Illuminate\Support\Facades\Validator;
use Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::paginate(5);
       // $movies = Post::paginate(5);

        return response()->json([
            "status" => 1,
            "message" => "Post fetched",
            "data" => $movies
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
         "user_id" => "required|exists:users,id",
            "title" =>"required",
            "description" => "required",
            "thumbnail" => "required|file|image|max:2048",
            "release_date" => "required",
             "genre" => "required"

        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "validation error",
                "data" => $validator->errors()->all()
            ]);
        }

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        $movie = Movie::create([
            "user_id" => $request->user_id, // Include user_id,
            "title" => $request->title,
            "description" => $request->description,
            "thumbnail" => $thumbnailPath, // Store the path of the uploaded file
            "release_date" => $request->release_date,
            "genre" => $request->genre,

        ]);
        return response()->json([
            "status" => 1,
            "message" => "post created",
            "data" => $movie
        ]);

    }
    public function show(Request $request, $id)
    {
        $movie = Movie::find($id);

        return response()->json([
            "status" => 1,
            "message" => "post created",
            "data" => $movie
        ]);
    }
    public  function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" =>"required",
            "description" => "required",
            "thumbnail" => "required",
            "release_date" => "required",
             "genre" => "required"

        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "validation error",
                "data" => $validator->errors()->all()
            ]);
    }
    $movie = Movie::find($id);
    $movie->title = $request->title;
    $movie->  description = $request->description;
    $movie-> thumbnail = $request->thumbnail;
    $movie-> release_date = $request->release_date;
    $movie-> genre = $request->genre;

    return response()->json([
        "status" => 1,
        "message" => "post Updated",
        "data" => $movie
    ]);
    }
    public function destroy(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return response()->json([
            "status" => 1,
            "message" => "post deleted",
            "data" => null
        ]);

    }
}
