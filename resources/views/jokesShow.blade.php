
@extends('layouts.app')

@section('content')

<?php 

     $jokes = App\jokes::orderBy('id','desc')->get();
?>
    @if(count($jokes)>0)

        @foreach($jokes as $joke)
        <div class="alert alert-info">
                <p style="text-align:center;">
                        
                    {{$joke->jokeText}}
                    <br>
                    
                        
                </p>
            </div>
        
        @endforeach

    @else
            <p> Nema viceva </p>
    @endif


@endsection


