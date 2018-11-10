@extends('layouts.app')


@section('content')
    {{'ID = '}}
    {{$userId = Auth::id()}}
    <br>
    {{'E-mail = '}}
    {{$email = Auth::user()->email}}



    <?php
    $id = Auth::id();
    $jokes = App\jokes::where('user_id',$id)->get();
    ?>

@if(count($jokes)>0)

    @foreach($jokes as $joke)
    <div class="alert alert-info">
            <p style="text-align:center;">
                    
                {{$joke->jokeText}}    
            </p>

            <a href="/mojprofil/delete/{{$joke->id}}">
                <button class="btn btn-primary">
                    Izbriši
                </button>
            </a>
    
            <a href="/mojprofil/edit/{{$joke->id}}">
                <button class="btn btn-primary">
                    Uredi
                </button>
            </a>
        </div>
        

 


    
    @endforeach

@else
        <p> Još nemate objavljenih viceva </p>
@endif


@endsection