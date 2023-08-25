<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Title' => 'required',
            'Genre' => 'required',
            'Description' => 'nullable'
        ]);

        $newMovie = Movie::create($data);

        return redirect(route('movies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        // Update movie data from database
        $data = $request->validate([
            'Title' => 'required',
            'Genre' => 'required',
            'Description' => 'nullable'
        ]);

        $movie->update($data);

        return redirect(route('movies.index')) -> with('success', 'Movie Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        // Delete Movie
        $movie -> delete();
        return redirect(route('movies.index')) -> with('success', 'Movie Deleted Successfully');
    }

    /**
     * Ask for removal // Removal Confirmation
     * 
     */
    public function destroyAsk (Movie $movie)
    {
        return view('movies.delete', ['movie' => $movie]);
    }
}
