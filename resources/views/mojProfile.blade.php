@extends('layouts.app')


@section('content')

<div class="well" id="usredini">
    
    <a href="/urediProfil">
        <button class="btn btn-primary" id="dugme">
        Uredi Profil
        </button>
    </a>

    @if(((Auth::user()->role) == 1)|| ((Auth::user()->role) == 2) )
        <a href="/mojprofil/adminpanel">
            <button class="btn btn-primary" id="dugme">
            Admin Panel
            </button>
        </a>
    @endif
</div>




    <!-- ISPIS SVIH VICEVA OD USER -->
    <?php
    $id = Auth::id();
    $jokes = App\jokes::where('user_id',$id)->get();
    ?>

@if(count($jokes)>0)

    @foreach($jokes as $joke)
        <div class="alert alert-info">

            <!--TEXT VICA -->
            <p style="text-align:center;">
                {{$joke->jokeText}}    
            </p>

            <!-- IZBRIŠI VIC -->
            <a href="/mojprofil/delete/{{$joke->id}}">
                <button class="btn btn-primary">
                    Izbriši
                </button>
            </a>
    
            <!-- UREDI VIC -->
            <a href="/mojprofil/edit/{{$joke->id}}">
                <button class="btn btn-primary">
                    Uredi
                </button>
            </a>
        </div>
    @endforeach

@else
        <p> Još nemate objavljenih viceva </p>
@endif


@endsection