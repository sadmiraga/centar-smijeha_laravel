<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;
use App\category;

class categoriesController extends Controller
{
    public function index(){
        $categories = category::all();
        return view('kategorije')->with('category',$categories);
    }

    public function show($category_id){
        
        $jokes = jokes::where('category_id',$category_id)->get();

        return view('jokesbycategory')->with('vicevi',$jokes);
        //return view('jokesbycategory',compact('jokes'))
        
    }

}


