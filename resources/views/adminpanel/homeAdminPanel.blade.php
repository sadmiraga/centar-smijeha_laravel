@extends('layouts.app')


@section('content')

<div class="well" id="usredini">
    <a href="/mojprofil/adminpanel/dodajkategoriju">
        <button class="btn btn-primary">
            Dodaj Kategoriju
        </button>
    </a>


    @yield('adminSection')
</div>

@endsection