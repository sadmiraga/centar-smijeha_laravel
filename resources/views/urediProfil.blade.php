@extends('layouts.app')


@section('content')

    <div id="usredini" class="well" style="text-align:center;">
        <h1> Uredi Profil </h1>
    </div>


    <!-- PASSWORD, E MAIL, USERNAME -->
    <div id="usredini" class="well">
        
        <!-- PASSWORD -->
        <a href="/changePassword">
            <button class="btn btn-primary" id="dugme">
                Promjeni password
            </button>
        </a>
        <br>
        <br>

        <!-- E-mail -->
        <a href="/changeEmail">
            <button class="btn btn-primary" id="dugme">
                Promjeni E-mail
            </button>
        </a>
        <br>
        <br>

        <!-- USERNAME -->
        <a href="/changeUsername">
            <button class="btn btn-primary" id="dugme">
                Promjeni Korisničko Ime
            </button>
        </a>

    </div>



@endsection