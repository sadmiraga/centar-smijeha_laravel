<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;

class profileController extends Controller
{
    public function index(){
        
        //$jokes = jokes::where('user_id',$userID)->get();

        //return view('mojProfile')->with('viceviOdUsera',$jokes);

        return view('mojProfile');
    }
}