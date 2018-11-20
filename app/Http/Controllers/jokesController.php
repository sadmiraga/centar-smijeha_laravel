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
        
        $joke = jokes::find($joke_id);
        $joke ->approve = 'yes';
        $joke->save();
        return redirect('/approveJokes');
    }

    //DECLINE JOKE EXECUTE

    public function declineJoke($joke_id){
        $jokes = jokes::findOrFail($joke_id);
        $jokes->delete();
        return redirect('/approveJokes');
    }

    
     //DIZAJN ZA APPROVE JOKES
    public function approveJokesDesign(){

        // pokupiti sve viceve koji nisu odobreni
        $jokesToApprove = jokes::where('approve','no')->get();

        return view('adminpanel.approveJokes')->with('jokes',$jokesToApprove);
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
        return view('editjoke')->with('joke_id',$id);
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
