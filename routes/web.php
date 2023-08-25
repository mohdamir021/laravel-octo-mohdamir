<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Movie 
Route::get('/movie', [MovieController::class, 'index']) -> name('movies.index');
Route::get('/movie/create', [MovieController::class, 'create']) -> name('movie.create');
Route::post('/movie', [MovieController::class, 'store']) -> name('movie.store');
Route::get('/movie/{movie}/edit', [MovieController::class, 'edit']) -> name('movie.edit');
Route::put('/movie/{movie}/update', [MovieController::class, 'update']) -> name('movie.update');
Route::get('/movie/{movie}/destroy/ask', [MovieController::class, 'destroyAsk']) -> name('movie.destroy.ask');
Route::delete('/movie/{movie}/destroy', [MovieController::class, 'destroy']) -> name('movie.destroy');


Route::get('/', function () {
    return view('welcome');
});
