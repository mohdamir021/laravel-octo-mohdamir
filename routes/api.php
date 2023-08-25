<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\MovieAPIController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(array('middleware' => ['custom_auth']), function ()
{
    Route::apiResource('token', TokenController::class);
    Route::post('/token/topup', [TokenController::class, 'store']);
});

// MovieAPI
Route::get('/movies', [MovieAPIController::class,'index']);
Route::get('/movie/{id}', [MovieAPIController::class,'show']);
Route::post('/movie', [MovieAPIController::class,'store']);
Route::put('/movie/{id}', [MovieAPIController::class,'update']);
Route::delete('/movie/{id}', [MovieAPIController::class,'destroy']);

Route::fallback(function (){
    return ["Error route"];
});




