@extends('layouts.app')

@section('content')

<?php
    $users = App\User::all();
?>


    @foreach($users as $user)
        {{$user->name}}
    @endforeach


@endsection