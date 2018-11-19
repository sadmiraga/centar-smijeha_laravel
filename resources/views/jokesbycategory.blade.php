@extends('layouts.app')


@section('content')

<?php
    $userID = Auth::id();

    //POKUPITI ID OD KATEGORIJE 
    foreach($vicevi as $joke){
        $idKategorije = $joke->category_id;
    }

    //POKUPIT KATEGORJU POMOCU predhodno dobijenog IDa
    $kategorije = App\category::where('id',$idKategorije)->get();

    //IME KATEGORIJE, provuc kroz foreach i uzet ime kategorije
    foreach($kategorije as $kategorija){
        $imeKategorije = $kategorija->categoryName;
    }
?>

<div class="well" id="usredini">
    <h1> {{$imeKategorije}} </h1>
</div>

   







<!-- provjeriti da li ima viceva u ovoj kategoriji -->
@if(count($vicevi)>0)
    @foreach ($vicevi as $joke)

        <!-- select USERNAME od authora -->
        <?php
            $users = App\User::where('id',$joke->user_id)->get();
            //pokupis vrijednost USERNAME
            foreach($users as $user){
                $username = $user->name;
            }
        ?>

        <div class="alert alert-info" id="vic">

            <!-- ispis TEXTa vica -->
            <p style="style=align:center;" id="textVica">
                {{$joke->jokeText}}
            </p>
            
            <!-- ispis imena autora -->
            <span id="imeAutora">
                {{$username}}
            </span>
            <br>

            <!-- provjera da li je user prijaveljen-->
            @if($juzer = Auth::user())

                <!-- provjera da li je user lajko ovaj vic -->
                <?php
                    $likeCount = App\likes::where([
                        'user_id' => $userID,
                        'joke_id' => $joke->id
                    ])->get();
                ?>
    
                    <!-- LIKE -->
                    @if(count($likeCount)==0)
                        <a href="/likeByCategory/{{$joke->id}}/{{$joke->category_id}}">
                            <button  class="btn btn-primary">
                                Like
                            </button>
                        </a>
                    <!--UNLIKE -->                    
                    @else
                        <a href="/unlikeByCategory/{{$joke->id}}/{{$joke->category_id}}">
                            <button  class="btn btn-primary">
                                Unlike
                            </button>
                        </a>
                    @endif       
            @endif
                        <!-- BROJ LAJKOVA POVLACENJE IZ BAZE -->
                        <?php
                            $lajkovi = App\likes::where('joke_id',$joke->id)->get();
                            $brojLajkova = count($lajkovi);
                        ?>

                        <!-- Ispis broja lajkova -->
                        <button id="brojLajkova" class="btn btn-primary">
                            {{$brojLajkova}}
                        </button> 


        </div>
    @endforeach
@else
    <p> Nema viceva u ovoj kategoriji </p>
@endif


@endsection