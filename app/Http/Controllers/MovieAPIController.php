<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        csrf_field();
        $movie = new Movie();
        $movie->Title = $request->Title;
        $movie->Genre = $request->Genre;
        $movie->Description = $request->Description;
        $movie->save();

        // $data = $request->validate([
        //     'Title' => 'required',
        //     'Genre' => 'required',
        //     'Description' => 'nullable'
        // ]);
        
        // $newMovie = Movie::create($data);

        return ["Data Movie is added"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieAPI  $movieAPI
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the Movie data and return message if not found
        $movies = Movie::all();
        $find = $movies->contains($id);
        if(!$find)
        {
            return ["No Movie Data found"];
        }//endif

        //Show movie data
        $movie = Movie::find($id);
        return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovieAPI  $movieAPI
     * @return \Illuminate\Http\Response
     */
    // public function edit(MovieAPI $movieAPI)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieAPI  $movieAPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        csrf_field();
        // Find the Movie data and return message if not found
        $movies = Movie::all();
        $find = $movies->contains($id);
        if(!$find)
        {
            return ["No Movie Data found"];
        }//endif
        
        $Title = $request->Title;
        $Genre = $request->Genre;
        $Description = $request->Description;

        $movie = Movie::find($id);
        $movie->Title = $Title;
        $movie->Genre = $Genre;
        $movie->Description = $Description;
        $movie->save();

        // Update movie data from database
        // $data = $request->validate([
        //     'Title' => 'required',
        //     'Genre' => 'required',
        //     'Description' => 'nullable'
        // ]);

        // $movie->update($data);

        return ["Movie data is updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovieAPI  $movieAPI
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the Movie data and return message if not found
        $movies = Movie::all();
        $find = $movies->contains($id);
        if(!$find)
        {
            return ["No Movie Data found"];
        }//endif


        // Delete Movie
        $movie = Movie::find($id);
        $movie -> delete();

        return ["Movie data is deleted "];
    }
}
