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


    //ALL JOKES 4 REAL
    public function index(){
      //get jokes
      $vicevi = jokes::paginate(5);

      //return
      return jokesResource::collection($vicevi);
    } 




}
