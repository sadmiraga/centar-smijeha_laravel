@extends('layouts.app')


@section('content')
    {{'ID = '}}
    {{$userId = Auth::id()}}
    <br>
    {{'E-mail = '}}
    {{$email = Auth::user()->email}}


    @foreach ($viceviOdUsera as $jokes)
        {{$jokes->joketext}}    
    @endforeach


@endsection