<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;
use App\category;
use App\User;

use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index(){
        
        //$jokes = jokes::where('user_id',$userID)->get();

        //return view('mojProfile')->with('viceviOdUsera',$jokes);

        return view('mojProfile');
    }

    public function adminPanel(){

        //head admin stranica
        if((Auth::user()->role)==1){
            return view('adminpanel.headAdminPanel');
        //regularni admin stranica
        } else if((Auth::user()->role)==2){
            return view('adminpanel.regularAdminPanel');
        }
    }

    //vracanje izgleda stranice za dodavanje kategorije
    public function dodajKategoriju(){
        return view('adminpanel.dodajKategoriju');
    }

    //dodavanje kategorije u bazu
    public function submitCategory(Request $request){
        
        //validacija
        $this->validate($request,[
            'categoryName' => 'required'
        ]);

        //nova ktegorija
        $category = new category;
        $category -> categoryName = $request->input('categoryName');

        $category->save();
        
        return redirect('/kategorije');

    }

    public function manageUsers(){
        return view('adminpanel.manageUsers');
    }

}
