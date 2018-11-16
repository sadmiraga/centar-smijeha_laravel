<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;
use App\category;
use App\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{

    //promjeni EMAIL execute 
    public function changeEmailSubmit(Request $request){
        $this->validate($request, [
            'newEmail' => 'required'
        ]);

        // ID OD USERA
        $userID = Auth::id();

        $user = User::find($userID);
        $user->email = $request->input('newEmail');

        $user->save();
        return redirect('urediProfil');
    }

    //promjeni USERNAME execute 
    public function changeUsernameSubmit(Request $request){
        $this->validate($request,[
            'newUsername' => 'required'
        ]);
        
        // ID OD USERA
        $userID = Auth::id();

        $user = User::find($userID);
        $user->name = $request->input('newUsername');

        $user->save();
        return redirect('urediProfil');

    }

    // uredi profil DIZAJn
    public function urediProfilDizajn(){
        return view ('urediProfil');
    }

    public function urediProfilSubmit(Request $request, $user_id){
        return $user_id;
    }

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
            return view('adminpanel.homeAdminPanel');
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
