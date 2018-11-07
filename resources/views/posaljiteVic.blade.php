@extends('layouts.app')

@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    
    {!! Form::open(['url' => 'posaljitevic/submit']) !!}
        <div class="form-group" id="submitform">
            {{Form::textarea('jokeText','', ['class' => 'form-control', 'placeholder'=>'Napišite vic', 'rows'=>'3', 'cols'=>'2'] )}}
        </div>

        <div class="text-center">
            {{Form::submit('Pošalji',['class'=>'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection