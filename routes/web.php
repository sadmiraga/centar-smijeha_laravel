<?php

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

/*Route::get('/', function () {
   return view ('home');
});
*/

Route::get('/posaljitevic',function(){
    return view('posaljiteVic');
});


Route::get('/', function () {
    return view ('jokesShow');
 });

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function(){
    return view('jokesShow');
});




Route::get('/admin', function(){
    return 'Ti si sad kao admin jel?';
});

Route::get('/users/{username}',function($username){
    return 'Ovo je stranica od '. $username;
});


//Route::get('jokes/destroy', 'jokesController@destroy');



Route::get('/alljokes',function(){
    return view('jokesShow');
});

Route::resource('jokes','jokesController');

Route::get('/kategorije',function(){
    return view('kategorije');
});



//submiting a form 
Route::post('/posaljitevic/submit', 'jokesController@submit');