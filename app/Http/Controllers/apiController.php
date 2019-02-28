<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\jokes;

use App\Http\Resources\jokes as jokesResource;

class apiController extends Controller
{
    public function apiAllJokes(){
        //array allJokes = jokes::all();
        $allJokes = jokes::all();
        return response()->json($allJokes);
    }


    public function test(){

        $vicevi = jokes::all()->toArray();
        return response()->json($vicevi); 

        /*         foreach ($viceviData as $vic){
            
             $data = [
                'id' => $vic->id,
                'created_at' => $vic->created_at,
                'jokeText' => $vic->jokeText,
                'category_id' => $vic->category_id,
                'user_id' => $vic->user_id,
            ];  
        } */
    }

    //ALL JOKES 4 REAL
    public function index(){
      //get jokes
      $vicevi = jokes::paginate(5);

      //return
      return jokesResource::collection($vicevi);
    } 




}
