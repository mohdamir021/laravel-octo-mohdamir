<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Review;
use App\Models\Theater;
use App\Models\Theaterslot;
use \DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return MovieResource::collection(Movie::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreMovieRequest $request)
    public function store(Request $request)
    {
        //Genre (>1)
        $genre = $request->genre;
        if(!is_scalar($genre))
            $genre = $this->paramToString($genre);
            //Performer(>1)
            $performer = $request->performer;
            if(!is_scalar($performer))
            $performer = $this->paramToString($performer);
        
            
            $movie = Movie::create([
                'title' => $request->title,
                'release' => $request->release,
                'length' => $request->length,
                'description' => $request->description,
                'mpaa_rating' => $request->mpaa_rating,
                'genre' => $genre,
                'director' => $request->director,
                'performer' => $performer,
                'language' => $request->language
            ]);
            
            return response()->json([
                'message' => "Successfully added movie ".$movie->title.
                    " with Movie_ID ".$movie->id,
                "success" => true
            ]);
            // return new MovieResource($movie);
            // return Request::createFromGlobals()->all(); //Check for parameters received
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($movieid)
    {
        if($movie = Movie::find($movieid)){
            return new MovieResource($movie);
        }else{
            return "Movie not found";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateMovieRequest $request, Movie $movie)
    public function update(Request $request, Movie $movie)
    {
        //Genre (>1)
        $genre = $request->genre;
        if(!is_scalar($genre))
            $genre = $this->paramToString($genre);
            //Performer(>1)
            $performer = $request->performer;
            if(!is_scalar($performer))
            $performer = $this->paramToString($performer);
            
            // Data
            $data = [
                'title' => $request->title,
                'release' => $request->release,
                'length' => $request->length,
            'description' => $request->description,
            'mpaa_rating' => $request->mpaa_rating,
            'genre' => $genre,
            'director' => $request->director,
            'performer' => $performer,
            'language' => $request->language
        ];
        
        $movie->update($data);
        
        return "Movie data Updated";
        // return Request::createFromGlobals()->all(); //Check for parameters received
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return "Movie Data deleted";
    }

    //Essentials
    public function getGenre(Request $request){
        
        $genre = $request->genre;
        $movies = Movie::where('genre', 'LIKE', '%'.$genre.'%')->get();

        $data = array();
        foreach($movies as $movie){
            array_push($data, [
                'Movie_ID' => $movie->id,
                'Title' => $movie->title,
                'Genre' => $genre,
                'Description' => $movie->description
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }
    public function timeSlot(Request $request){

        $theater_name = $request->theater_name;

        $theaters = Theater::where('theater_name', 'LIKE', $theater_name)->get();
        $theater = $theaters->first(); // Get only one row

        $theater_slots = Theaterslot::
            where('theater_id', "=", $theater->id)->
            where('start_time', ">", $request->time_start)->
            where('end_time', "<", $request->time_end)->get();

        $data = array();//Find movies
        foreach($theater_slots as $theater_slot){
            
            $movieid = $theater_slot->movie_id;
            $movies = Movie::where('id','=',$movieid)->get();
            $movie = $movies->first();

            array_push($data,[
                'Movie_ID' => $movie->id,
                'Title' => $movie->title,
                'Theater_name' => $theater->theater_name,
                'Start_time' => $theater_slot->start_time,
                'End_time' => $theater_slot->end_time,
                'Description' => $movie->description,
                'Theater_room_no' => $theater_slot->room_no,
            ]);
        }

        return response()->json(['data'=>$data]);
    }
    public function specificMovieTheater(Request $request){
        
        $theater_name = $request->theater_name;

        $theaters = Theater::where('theater_name', 'LIKE', $theater_name)->get();
        $theater = $theaters->first(); // Get only one row

        $theater_slots = Theaterslot::
            where('theater_id', "=", $theater->id)->
            whereDate('start_time', $request->d_date)->get();

        $data = array();//Find movies
        foreach($theater_slots as $theater_slot){
            
            $movieid = $theater_slot->movie_id;
            $movies = Movie::where('id','=',$movieid)->get();
            $movie = $movies->first();
            array_push($data,[
                'Movie_ID' => $movie->id,
                'Title' => $movie->title,
                'Theater_name' => $theater->theater_name,
                'Start_time' => $theater_slot->start_time,
                'End_time' => $theater_slot->end_time,
                'Description' => $movie->description,
                'Theater_room_no' => $theater_slot->room_no,
            ]);
        }

        return response()->json(['data'=>$data]);
    }
    public function searchPerformer(Request $request){

        $pfname = $request->performer_name;

        $movies = Movie::where('performer', 'LIKE', '%'.$pfname.'%')->get();

        $rating = "No Ratings";

        $data = array();

        foreach($movies as $movie){

            $reviews = Review::where('movie_title', 'LIKE', '%'.$movie->title.'%')->get();
            if(sizeof($reviews) > 0){
                $count = 0;
                foreach($reviews as $r){
                    $count = $count + $r->rating;
                }
                $rating = $count / sizeof($reviews);
            }

            array_push($data, [
                'Movie_ID' => $movie->id,
                "Overall_rating" => $rating,
                "Title" => $movie->title,
                "Description" => $movie->description
            ]);
        }

        return response()->json(['data' => $data]);
    }


    // Additional Method
    public function paramToArray($string){
        return explode(',',$string);
    }

    public function paramToString($array){
        $str ="";
        $num = 1;
        $max = sizeof($array);
        foreach($array as $g){
            $str = $str.$g;
            $num++;
            if($num <= $max)
                $str = $str.",";
        }
        return $str;
    }
}
