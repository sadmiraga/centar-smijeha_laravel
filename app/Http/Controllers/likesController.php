<?php

namespace App\Http\Controllers;
use App\likes;
use Auth;

use Illuminate\Http\Request;

class likesController extends Controller
{

    //UNLIKE NA TOP VICEVIMA I VRACANJE NA ISTU KATEGORIJU
    public function unlikeByTop($joke_id){
        
        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }

        //id od prijavljenog usera
        $userID = Auth::id();

        //Provjera da li je user vec Like taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();
        
        //prevent unlike spam
        if(count($likeCheck)==0){
            return redirect()->back();
        }

        //pokupiti ID iz LIKES po predhodnim parametrima
        $likeIdTest = likes::where([
            'user_id' => $userID,
            'joke_id' => $joke_id
        ])->get();

        foreach($likeIdTest as $likeIdTestTest){
            $likeID = $likeIdTestTest->id;
        }

        //pronadji LIKES i DELETE
        $like = likes::findOrFail($likeID);
        $like->delete();
        return redirect('/najboljiVicevi');

    }

    //LIKE NA TOP VICEVIMA I VRACANJE NA ISTU KATEGORIJU
    public function likeByTop($joke_id){

        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }

        //ID od usera koji je prijaveljen
        $userID = Auth::id();

        //Provjera da li je user vec Like taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();

        //prevent like spam
        if(count($likeCheck)>0){
            return redirect()->back();
        }


        //novi like 
        $like = new likes;
        $like->user_id = $userID;
        $like->joke_id = $joke_id;
        $like->save();

        //redirect
        return redirect('/najboljiVicevi');
    }

    //UNLIKE NA VICEVIMA PO KATEGORIJI  I REDIRECT NA VICEVE Iz Te KATEGORIJE
    public function unlikeByCategory($joke_id,$category_id){

        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }

        //id od usera koji unlike
        $userID = Auth::id();

        //Provjera da li je user vec Like taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();

        //prevent unlike spam
        if(count($likeCheck)==0){
            return redirect()->back();
        }

        //uzmi id lajka po predhodnim parametrima
        $likeIdTest = likes::where([
            'user_id' => $userID,
            'joke_id' => $joke_id
        ])->get();

        foreach($likeIdTest as $likeIdTestTest){
            $likeID = $likeIdTestTest->id;
        }

        //pronadji tu foru u bazi
        $like = likes::findOrFail($likeID);
        $like->delete();
        return redirect("/kategorije/$category_id");  
    }

    //LIKE NA VICEVIMA PO KATEGORIJI  I REDIRECT NA VICEVE Iz Te KATEGORIJE
    public function likeByCategory($joke_id,$category_id){

        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }

        //ID od usera koji je prijavljen
        $userID = Auth::id();

        //Provjera da li je user vec Like taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();

        //prevent like spam
        if(count($likeCheck)>0){
            return redirect()->back();
        }
        
        //novi LIKE
        $like = new likes;
        $like->user_id = $userID;
        $like->joke_id = $joke_id;

        $like->save();

        return redirect("/kategorije/$category_id");
    }


    //LIKE NA POCETNOJ
    public function like($joke_id){
        
        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }


        //ID od usera koji je prijavljen
        $userID = Auth::id();

        //Provjera da li je user vec Like taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();


        //Spriječavanje LIKE SPAM na početnoj
        if(count($likeCheck)>0){
            return redirect()->back();
        }
        
        //novi LIKE
        $like = new likes;
        $like->user_id = $userID;
        $like->joke_id = $joke_id;

        $like->save();

        return redirect('/');
    }

    //UNLIKE NA POCETNOJ
    public function unlike($joke_id){

        //provjeriti da li je prijavljen
        if(Auth::guest()){
            return redirect('/login');
        }

        //id od usera koji unlike
        $userID = Auth::id();

        //potrazit iz baze da li je user lajko taj vic
        $likeCheck = likes::where([
            'joke_id' => $joke_id,
            'user_id' => $userID
        ])->get();

        //spriječavanje unlike spamma
        if(count($likeCheck)==0){
            return redirect()->back();
        }

        //uzmi id lajka po predhodnim parametrima
        $likeIdTest = likes::where([
            'user_id' => $userID,
            'joke_id' => $joke_id
        ])->get();

        foreach($likeIdTest as $likeIdTestTest){
            $likeID = $likeIdTestTest->id;
        }

        //pronadji tu foru u bazi
        $like = likes::findOrFail($likeID);
        $like->delete();
        return redirect('/');   
    }
}
