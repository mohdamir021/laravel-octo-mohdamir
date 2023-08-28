<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        return Review::all();
    }

    public function store(Request $request){
        
        $movies = Movie::where('title','LIKE','%'.$request->movie_title.'%');
        $movie = $movies->first();

        $rating = Review::create([
            'movie_title' => $movie->title,
            'username' => $request->username,
            'rating' => $request->rating,
            'r_description' => $request->r_description,
        ]);

        return response()->json([
            'message' => "Review for ".$rating->movie_title.
                " added by ".$rating->username,
            'success'=> true
        ]);
    }
}
