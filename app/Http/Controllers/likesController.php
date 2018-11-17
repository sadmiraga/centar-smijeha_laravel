<?php

namespace App\Http\Controllers;
use App\likes;
use Auth;

use Illuminate\Http\Request;

class likesController extends Controller
{

    //UNLIKE NA TOP VICEVIMA I VRACANJE NA ISTU KATEGORIJU
    public function unlikeByTop($joke_id){
        
        //id od prijavljenog usera
        $userID = Auth::id();

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

        //ID od usera koji je prijaveljen
        $userID = Auth::id();

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
        //id od usera koji unlike
        $userID = Auth::id();

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

        //ID od usera koji je prijavljen
        $userID = Auth::id();
        
        //novi LIKE
        $like = new likes;
        $like->user_id = $userID;
        $like->joke_id = $joke_id;

        $like->save();

        return redirect("/kategorije/$category_id");
    }


    //LIKE NA POCETNOJ
    public function like($joke_id){
        
        //ID od usera koji je prijavljen
        $userID = Auth::id();
        
        //novi LIKE
        $like = new likes;
        $like->user_id = $userID;
        $like->joke_id = $joke_id;

        $like->save();

        return redirect('/');
    }

    //UNLIKE NA POCETNOJ
    public function unlike($joke_id){

        //id od usera koji unlike
        $userID = Auth::id();

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
