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

// CHANGE PASSWORD SUBMIT 
Route::post('changePasswordSubmit', 'profileController@changePasswordSubmit');

//UNLIKE SA TOP VICEVA
Route::get('/unlikeByTop/{joke_id}', 'likesController@unlikeByTop');

//LIKE SA TOP VICEVA
Route::get('/likeByTop/{joke_id}', 'likesController@likeByTop');

//Najbolji vicevi
Route::get('/najboljiVicevi','jokesController@bestJokes');

//ODBIJ VIC EXECUTE 
Route::get('/declineJoke/{joke_id}', 'jokesController@declineJoke');

// ODOBRI VIC EXECUTE 
Route::get('/approveJoke/{joke_id}','jokesController@approveJoke');

//APPROVE JOKES DIZAJN 
Route::get('/approveJokes','jokesController@approveJokesDesign');


// vrati dizajn za password change
Route::get('/changePassword', function(){
    if(Auth::guest()){
        return redirect('/login');
    }
    return view('/myProfile.changePassword');
});

// change EMAIL execute 
Route::post('changeEmailSubmit', 'profileController@changeEmailSubmit');

// vrati dizajn za change EMAIL 
Route::get('/changeEmail', function(){

    if(Auth::guest()){
        return redirect('/login');
    }

    return view('myProfile.changeEmail');
});


// EXECUTE CHANGE USERNAME
Route::post('changeUsernameSubmit','profileController@changeUsernameSubmit');

// VRATI DIZAJN ZA CHANGE USERNAME
Route::get('/changeUsername', function(){

    if(Auth::guest()){
        return redirect('/login');
    }

    return view('myProfile.changeUsername');
});

//UREDI PROFIL DIZAJN 
Route::get('urediProfil', 'profileController@urediProfilDizajn');

//UNLIKE SA VICEVA PO KATEGORIJI i VRACA NA VICEVE IZ TE KATEGORIJE
Route::get('/unlikeByCategory/{joke_id}/{category_id}','likesController@unlikeByCategory');

//LIKE SA VICEVA PO KATEGORIJI i VRACA NA VICEVE IZ TE KATEGORIJE
Route::get('/likeByCategory/{joke_id}/{category_id}', 'likesController@likeByCategory');

//UNLIKE SA POCETNE EXECUTE
Route::get('/unlike/{like_id}', 'likesController@unlike');

//LIKE SA POCETNE EXECUTE
Route::get('/like/{joke_id}', 'likesController@like');


//execute uredjivanje korisnika
Route::post('/editUser/uredi/{id}','usersController@uredi');

//UREDI  KORISNIKA PRIKAZ FORME
Route::get('/editUser/{user_id}', 'usersController@update');

//IZBRIŠI KORISNIKA
Route::get('/deleteUser/{user_id}','usersController@destroy');


Route::get('/manageUsers', 'profileController@manageUsers');

//submit kategorije 
Route::post('/submitCategory', 'profileController@submitCategory');

//dodaj kategoriju izgled 
Route::get('/mojprofil/adminpanel/dodajkategoriju', 'profileController@dodajKategoriju' );

//admin PANEL izled 
Route::get('/mojprofil/adminpanel', 'profileController@adminPanel');


//execute uredjivanja fore
Route::get('/mojprofil/uredi/{{joke_id}}', 'jokesController@update');


//samo vraca blade za uredjivanje fore
Route::get('/mojprofil/edit/{joke_id}', 'jokesController@edit');

Route::get('/mojprofil/delete/{joke_id}', 'jokesController@destroy' );

Route::get('/mojprofil', 'profileController@index');

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



Route::get('kategorije/{category_id}', 'categoriesController@show');

//Route::get('jokes/destroy', 'jokesController@destroy');


Route::resource('jokes','jokesController');

Route::get('/kategorije',function(){
    return view('kategorije');
});



//submiting a form 
Route::post('/posaljitevic/submit', 'jokesController@submit');