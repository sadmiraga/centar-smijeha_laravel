@extends('layouts.app')


@section('content')

@if(count($vicevi)>0)


    @foreach ($vicevi as $joke)

        <div class="alert alert-info">
            <p style="text-align:center;">
                {{$joke->jokeText}}
            </p>
        </div>
    @endforeach

@else
    <p> Nema viceva u ovoj kategoriji </p>
@endif


@endsection