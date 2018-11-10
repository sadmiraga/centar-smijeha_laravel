<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jokes;
use App\category;
use Illuminate\Support\Facades\Auth;

class jokesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        //novi vic
        $jokes = jokes::find($id);
        $jokes->jokeText = $request->input('jokeText');
        $jokes->category_id = $request->input('category_id');
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
        return redirect('/');

       
    }

    public function submit(Request $request){
        $this->validate($request, [
            'jokeText' => 'required'
        ]);
        
        //novi vic
        $jokes = new jokes;
        $jokes->jokeText = $request->input('jokeText');
        $jokes->category_id = $request->input('category_id');
        if($user = Auth::user()){
            $jokes->user_id = Auth::id();
        }

        $jokes->save();

        //redirect

        return redirect('/');
    }

    
}
