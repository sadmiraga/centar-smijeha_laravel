@extends('layouts.app')

@section('content')
    <h1 style="text-align:center;"> ALL JOKES </h1>

    @if(count($jokes)>1)
        @foreach($jokes as $joke)
            <div class="alert alert-info">
                <p style="text-align:center;"> {{$joke->jokeText}}
            </div>
        @endforeach
    @else 
        <p> No jokes </p>
    @endif
@endsection