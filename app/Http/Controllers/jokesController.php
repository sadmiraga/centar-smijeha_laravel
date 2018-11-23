<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;
use App\category;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;

use Illuminate\Support\Facades\DB;

class jokesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //BEST JOKES 
    public function bestJokes(){
        
        // VICEVI PO BROJU LAJKOVA
        // SALJE --- joke.id, joke.jokeText, joke.user_id
        $vicevi = jokes::join('likes', 'jokes.id', '=', 'likes.joke_id')
                ->select(DB::raw('count(*) as brojLajkova,jokes.id,jokes.jokeText,jokes.user_id'))
                ->where('approve','yes')
                ->groupBy('jokes.id','jokes.jokeText','jokes.user_id')
                ->orderBy('brojLajkova','desc')
                ->get();
        
        return view('bestJokes')->with('jokes',$vicevi);
    }


    //APPROVE JOKE EXECUTE
    public function approveJoke($joke_id){
        
        //provjerit da li je user uopste prijavljen
        if(Auth::guest()){
            return redirect('/login');
        } else {

            //provjeriti da li je lik uopste admin ili head admin 
            if((Auth::user()->role)==1 || (Auth::user()->role)==2){
                $joke = jokes::find($joke_id);
                $joke ->approve = 'yes';
                $joke->save();
                return redirect('/approveJokes');
            } else {
                // ako obicni korisnik pokusa da odobrava viceve
                return redirect('/mojprofil');
            }
        }
    }

    //DECLINE JOKE EXECUTE

    public function declineJoke($joke_id){

        //provjeriti da li je uopste prijavljen 
        if(Auth::guest()){
            return redirect('/login');
        } else {
            if(Auth::user()->role == 1 || Auth::user()->role == 2){
                $jokes = jokes::findOrFail($joke_id);
                $jokes->delete();
                return redirect('/approveJokes');
            } else {
                return redirect('/mojprofil');
            }
        }
    }

    
     //DIZAJN ZA APPROVE JOKES
    public function approveJokesDesign(){

        // pokupiti sve viceve koji nisu odobreni
        $jokesToApprove = jokes::where('approve','no')->get();

        //provjeriti da li gost pokusava da dostupi do Approve jokes 
        if(Auth::guest()){
            return redirect('/login');
        } else {
            //provjerit da lije admin ili head admin
            if(((Auth::user()->role)==1) || (Auth::user()->role==2)){
                return view('adminpanel.approveJokes')->with('jokes',$jokesToApprove);
            } else {
                return redirect('/mojprofil');
            }
        }   
    }



    public function index()
    {   
        
        //$jokes = jokes::all();
        //return view('app')->with('jokes', $jokes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'ok';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //pokupiti user_id od ove fore, tj da vidimo ko je objavio radi verifikacije
        $fora = jokes::find($id);
        $AuthorID = $fora->user_id;

        // provjeriti da li korisnik pokusava da uredi tuđu foru
        if((Auth::id()) != $AuthorID){
            return redirect('/mojprofil');
        } else {
            //ako je prosao sve provjerete da se vrati edit joke design
            return view('editjoke')->with('joke_id',$id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jokeText' => 'required'
        ]);
        
        //uredjivanje vica
        $jokes = jokes::find($id);
        $jokes->jokeText = $request->input('jokeText');
        $jokes->category_id = $request->input('category_id');

        // Pokupiti nivo korisnika
        $userRole = Auth::user()->role;

        //ako je head admin promjenio svoju šalu da ne mjenja apporve nego samo za obicne korisniek
        if($userRole != 1){
            $jokes->approve = 'no';
        }
        
        if($user = Auth::user()){
            $jokes->user_id = Auth::id();
        }

        $jokes->save();

        //redirect

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //pronadji user_id iz fore 
        $fora = jokes::find($id);
        $userIdCheck = $fora->user_id;

        //pokusava da izbrise vic kao gost
        if(Auth::guest()){
            return redirect('/login');
        } else {
            // user pokusava da izbrise tudji vic
            if((Auth::id())!= $userIdCheck){
                return redirect('/mojprofil');
            }
        }
        
        $jokes = jokes::findOrFail($id);
        $jokes->delete();
        return redirect('/mojprofil');
    }

    public function submit(Request $request){


        //PROVJERA PODATAKA ZA GOSTA
        if(Auth::guest()){
            $this->validate($request, [
                'jokeText' => 'required',
                'g-recaptcha-response' => 'required|captcha'            
            ]);
        //PROVJERA PODATAKA ZA KORISNIKA
        } else {
            $this->validate($request, [
                'jokeText' => 'required',  
            ]);
        }

        
        
    
        
        //novi vic
        $jokes = new jokes;
        $jokes->jokeText = $request->input('jokeText');
        $jokes->category_id = $request->input('category_id');
        if($user = Auth::user()){
            $jokes->user_id = Auth::id();
                //ako je Head Admin objavio vic da je automatski odobren
                if((Auth::user()->role)==1){
                    $jokes->approve = 'yes';
                }
        }

        $jokes->save();

        //redirect
        //return redirect('/posaljitevic');

        // SUCCESS poruka za korisnika
        if($user = Auth::user()){
            return redirect()->back()->with('successMessage','Vaš vic je poslan, prije nego što vic bude objavljen potrebno je da bude odobren od strane admina. Stanje vaseg vica možete da provjerite na vašem profilu');
        } else {
            return redirect()->back()->with('successMessage','Vaš vic je poslan, prije nego što vic bude objavljen potrebno je da bude odobren od strane admina.');
        }
        

    }

    
}
