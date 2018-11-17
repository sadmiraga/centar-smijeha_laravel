@extends('layouts.app')


@section('content')

<div class="well" id=usredini>
    <h1> Admin Panel </h1>
</div>

<div class="well" id="usredini">
    <!-- DODAJ KATEGORIJU -->
    <a href="/mojprofil/adminpanel/dodajkategoriju">
        <button class="btn btn-primary" id="dugme">
            Dodaj Kategoriju
        </button>
    </a>
    <br>
    <br>

    <!-- ODOBRI VICEVE -->
    <a href="/approveJokes">
        <button class="btn btn-primary" id="dugme">
            Odobri Viceve
        </button>
    </a>
    <br>
    <br>


    @yield('adminSection')
</div>

@endsection