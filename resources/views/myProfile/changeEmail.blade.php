@extends('layouts.app')

@section('content')

    <!-- VRIJEDNOST E-maila  za placeholder -->
    <?php
        $stariEmail = Auth::user()->email;
    ?>

    <!-- NASLOV STRANICE -->
    <div class="well" id="usredini">
        <h1> Promjeni Email </h1>
    </div>
    
    <!-- ERRORI -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif


    <div class="well" id="usredini">
    <!-- FORMA -->
        {!! Form::open(['action'=>'profileController@changeEmailSubmit','method'=>'POST'])!!}
            {{Form::text('newEmail',"$stariEmail",['class'=>'form-control'])}}
            <br>
            <div style="text-align:center;">
                {{Form::submit('spremi',['class'=>'btn btn-primary'])}}
            </div>
        {!! FOrm::close()!!}
    </div>
@endsection