<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apiJokes', 'apiController@apiAllJokes');


//svi vicevi
Route::get('/vicevi','apiController@index');

//jedan vic
Route::get('/vic/{id}','apiController@show');

//novi vic
Route::post('/vic/{id}','apiController@store');

//uredi vic
Route::put('/vic','apiController@store');

//izbrisi vic
Route::delete('/vic','apiController@destroy');


//HELP 
Route::get("/help", "apiController@test");