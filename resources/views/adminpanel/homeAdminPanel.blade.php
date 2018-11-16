@extends('layouts.app')


@section('content')

<div class="well" id="usredini">

    <!-- DODAJ KATEGORIJU -->
    <a href="/mojprofil/adminpanel/dodajkategoriju">
        <button class="btn btn-primary">
            Dodaj Kategoriju
        </button>
    </a>

    <!-- ODOBRI VICEVE -->
    <a href="/approveJokes">
        <button class="btn btn-primary">
            Odobri Viceve
        </button>
    </a>


    @yield('adminSection')
</div>

@endsection