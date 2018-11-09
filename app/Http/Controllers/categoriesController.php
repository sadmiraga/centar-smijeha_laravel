<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\category;

class categoriesController extends Controller
{
    public function index(){
        $categories = category::all();
        return view('kategorije')->with('category',$categories);
    }
}


