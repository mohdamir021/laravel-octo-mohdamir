<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(array('middleware' => ['custom_auth']), function ()
// {
//     Route::apiResource('token', TokenController::class);
//     Route::post('/token/topup', [TokenController::class, 'store']);
// });

// Final - Movie API
Route::apiResource('/movies', MovieController::class);
Route::get('/theater', 'TheaterController@index');
Route::post('/theater', 'TheaterController@store');
Route::post('/theater/{movie}/{theater}', 'TheaterController@insertSlot');
Route::get('/review', 'ReviewController@index');
Route::post('/give_rating', 'ReviewController@store');
Route::post('/add_movie', 'MovieController@store');
Route::get('/genre', 'MovieController@getGenre');
Route::get('/timeslot', 'MovieController@timeSlot');
Route::get('/specific_movie_theater', 'MovieController@specificMovieTheater');
Route::get('/search_performer', 'MovieController@searchPerformer');

Route::fallback(function (){
    return response()->json([
        'message' => 'Error Route'
    ]);
});





// MovieAPI - deleted
// Route::get('/movies', [MovieAPIController::class,'index']);
// Route::get('/movie/{id}', [MovieAPIController::class,'show']);
// Route::post('/movie', [MovieAPIController::class,'store']);
// Route::put('/movie/{id}', [MovieAPIController::class,'update']);
// Route::delete('/movie/{id}', [MovieAPIController::class,'destroy']);