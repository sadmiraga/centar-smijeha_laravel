@extends('layouts.app')

@section('content')

<?php
    $userID = $user->id;
    $userRole = $user->role;
?>


<div class="alert alert-info" id="urediKorisnika">
    {{$user->name}}


    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif

    {!! Form::open(['action'=>['usersController@uredi',$userID],'method'=>'POST']) !!}
    <div class="form-group" id="submitform">
        <select name="role" class="form-control">

            <!-- DEFAULT HEAD ADMIN -->
            @if($userRole == 1)
                <option selected="selected" value="1">Head Admin</option>
            @else
                <option value="1">Head Admin</option>
            @endif

            <!-- DEFAULT ADMIN -->
            @if($userRole == 2)
                <option selected="selected" value="2">Admin</option>
            @else
                <option value="2">Admin</option>
            @endif

            <!-- DEFAULT USER -->
            @if($userRole == 3)
                <option selected="selected" value="3">Korisnik</option>
            @else 
                <option value="3">Korisnik</option>
            @endif

        </select>
    
    </div>

   

    <div class="text-center">
        {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
    </div>
{!! Form::close() !!}


</div>




@endsection