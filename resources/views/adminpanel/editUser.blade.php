@extends('layouts.app')

@section('content')

<?php
    $userID = $user->id;
?>


<div class="alert alert-info" id="urediKorisnika">
    {{$user->name}}
    {{$user->id}}


    @if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div id="errorMessages" class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

    {!! Form::open(['action'=>['usersController@uredi',$userID],'method'=>'POST']) !!}
    <div class="form-group" id="submitform">
        <select name="role">
            <option value="1">Head Admin</option>
            <option value="2">Admin</option>
            <option value="3">Korisnik</option>
        </select>
    
    </div>

   

    <div class="text-center">
        {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}


</div>




@endsection