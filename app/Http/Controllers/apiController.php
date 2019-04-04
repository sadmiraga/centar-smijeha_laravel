<?php

namespace App\Http\Controllers;
use App\jokes;
use App\category;
use App\User;
use Hash;
use App\likes;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function apiAllJokes(){
        //array allJokes = jokes::all();
        $allJokes = jokes::all();
        return response()->json($allJokes);
    }

    //SVI VICEVI
    public function test(){
        
        $broj = jokes::where('approve','yes')->count();
        
        return jokes::where('approve','yes')->orderBy('created_at','desc')->paginate($broj);
        //return jokes::all();
        
    }
    
    //SVE KATEGORIJE
    public function getAllCategories(){
        $broj = category::count();
        return category::orderBy('created_at','desc')->paginate($broj);
        
    }
    
    public function like(Request $request){
        
        $userID = $request['userID'];
        $jokeID = $request['jokeID'];
        
        $likes = likes::where([
                'joke_id' => $jokeID,
                'user_id' => $userID
            ])->get();
            
        //check if user already liked that joke  
        if(count($likes)==0){
            
            //execute like - add LIKE
            $like = new likes;
            $like->user_id = $userID;
            $like->joke_id = $jokeID;
            $like->save();
            
            //notify about LIKED JOKE
            return response()->json([
                    'executed' => 'success',
                    'message' => 'Uspijesno ste oznacili vic sa SVIĐA MI SE'
                ])->withCallback($request->input('callback'));
            
            
        } else {
            
            return response()->json([
                    'executed' => 'failed',
                    'message' => 'Ovaj vic ste vec označili sa sviđa mi se'

                ])->withCallback($request->input('callback'));
            
        }
        
    
        
    }
    

    //VICEVI PO KATEGORIJI
        public function jokesByCategories($category_id){
        
        $broj= jokes::where([
                'category_id' => $category_id,
                'approve' => 'yes'
            ])->count();
            
        $jokes = jokes::where([
            'category_id' => $category_id,
            'approve' => 'yes'
        ])->orderBy('created_at','DESC')->paginate($broj);            

        return $jokes;
        
    }
    
    //NOVI VIC 
    public function newJoke(Request $request){
    
        $joke = new jokes;
        $joke->jokeText = $request['jokeText'];
        //$joke->approve = 'no';
        
        //mozda probat ko string
        $joke->user_id = $request['user_id'];
        
        $korisnik = User::find($request['user_id']);
        $role = $korisnik->role;
        
        //ako je head admin da je vic automatski odobren
        if($role==1){
            $joke->approve = 'yes';
        } else {
            $joke->approve = 'no';
        }
        
        
        
        $joke->category_id = $request['category_id'];
        
        $joke->save();
        return response()->json($joke, 200);
        
    }
    
    public function login(Request $request){
        
        // pokupit podatke poslane na api
        $email = $request['email'];
        $password = $request['password'];
        

        $user = User::where('email',$email)->get();
        
        foreach($user  as $juzer){
            $databasePassword = $juzer->password;
        }
        
        
        
        if(  (count($user)>0) &&  (Hash::check($password,$databasePassword))  )  {
            $exist  = 'yes';
            
            //pokupiti ID
            $user = User::where('email',$email)->first();
            
            $userID = $user->id;
            $userRole = $user->role;
            $userName = $user->name;
            
            //nova fora da vidimo jel stignu podaci sa aplikacije 
            //$joke = new jokes;
            //$joke->jokeText = $userName;
            //$joke->approve = 'yes';
            //$joke->user_id = 1;
            //$joke->category_id = 1;
            //$joke->save();
            
        } else {
            $exist = 'no';
            $userID = 1;
            $userRole = 0;
            $userName = 'unknown';
        }
        
            //$data = array()
            
            
        return response()->json([
            'exist' => $exist,
            'id' => $userID,
            'role' => $userRole,
            'name' => $userName
            
            ])->withCallback($request->input('callback'));
        
        
    }
    
    
    


}
