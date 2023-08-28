<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\Theaterslot;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index(){
        return Theater::all();
    }

    public function store(Request $request){

        $theater = Theater::create([
            'theater_name' => $request->theater_name
        ]);

        return "Theater added";
    }

    public function insertSlot(Request $request,$movie_id, $theater_id){
        $movie = Movie::find($movie_id);
        $theater = Theater::find($movie_id);
        if($movie == null || $theater == null){
            return "Movie or Theater not found";
        }

        $data = [
            'movie_id' => $movie_id,
            'theater_id' => $theater_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room_no' => $request->room_no,
        ];

        $theater_slot = Theaterslot::create($data);

        return "Theater slot added";
        
    }
}
