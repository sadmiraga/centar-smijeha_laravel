<?php

namespace App\Http\Controllers;
use App\likes;
use Auth;

use Illuminate\Http\Request;

class likesController extends Controller
{
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

    //UNLIKE JOKE
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
