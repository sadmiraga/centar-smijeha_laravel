<?php

namespace App\Http\Controllers;
use App\jokes;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function apiAllJokes(){
        return jokes::all();
    }
}
