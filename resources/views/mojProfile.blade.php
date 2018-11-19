@extends('layouts.app')


@section('content')

<div class="well" id="usredini">
        <h1> Moj Profil </h1>
</div>

<div class="well" id="usredini">
    
    <a href="/urediProfil">
        <button class="btn btn-primary" id="dugme">
        Uredi Profil
        </button>
    </a>
    <br>
    <br>

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

        <!-- boja u zavosnosti da li je objavljen ili ne -->
        @if(($joke->approve)=='no')
            <div class="alert alert-danger" id="vic">
        @else
            <div class="alert alert-info" id="vic">
        @endif

        
            
            <!--TEXT VICA -->
            <p style="text-align:center;">
                <?php
                    echo nl2br($joke->jokeText);
                ?>            
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

            @if(($joke->approve)=='no')
                <p id="nijeOdobren"> Vaš vic još nije odobren od strane admina </p>
            @endif

        </div>
    @endforeach




@else
        <div class="well" id="usredini">
            <p> Još nemate objavljenih viceva </p>
        </div>
@endif


@endsection