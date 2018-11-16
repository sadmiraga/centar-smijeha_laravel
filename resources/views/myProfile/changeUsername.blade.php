@extends('layouts.app')

@section('content')

    <!-- POKUPITI VRIJEDNOST IMENA ZA PLACEHOLDER -->
    <?php
        $staroIme = Auth::user()->name;
    ?>

    <!-- ERRORI -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif

    <!-- FORMA -->
    {!! Form::open(['action'=>'profileController@changeUsernameSubmit', 'method'=>'POST']) !!}
    
    <!-- text emaila-->
    {{ Form::text("newUsername","$staroIme",['class'=>'form-control'])}}
    
    <!-- submit button -->
    <div style="text-align:center;">
    {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
    {!! Form::close()!!}
    </div>


@endsection