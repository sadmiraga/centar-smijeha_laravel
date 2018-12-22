<?php

namespace App\Http\Controllers;
use App\jokes;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function apiAllJokes(){
        //array allJokes = jokes::all();
        $allJokes = jokes::all();
        return response()->json($allJokes);
    }




}
