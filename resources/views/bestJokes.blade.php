@extends('layouts.app')

@section('content')

    <div class="well" id="usredini">
        <h1> Top Vicevi </h1>
    </div>

  


    <!-- DA LI UOPSTE POSTOJE VICEVI KOJI SU LAJKOVANI -->
    @if(count($jokes)>0)
        @foreach($jokes as $joke)

            <!-- VRIJEDNOST USERNAMEA od autora koji je objavio ovaj vic preko id od vica -->
            <?php
                $users = App\User::where('id',$joke->user_id)->get();
                foreach($users as $user){
                    $username = $user->name;
                }
            ?>

            <!-- GLAVNI DIV U KOM SE NALAZI VIC -->
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

                <!-- provjera da li je user prijavljen -->
                @if($juzer = Auth::user())
                    
                    <!-- Provjera da li je user vec lajko ovaj vic -->
                    <?php
                        $likeCount = App\likes::where([
                            'user_id' => Auth::id(),
                            'joke_id' => $joke->id
                        ])->get();
                    ?>

                    <!-- LIKE -->
                    @if(count($likeCount)==0)
                        <button onclick='location.href="/likeByTop/{{$joke->id}}"' class="btn btn-primary">
                            Like
                        </button>
                    <!-- UNLIKE -->
                    @else
                        <button onclick='location.href="/unlikeByTop/{{$joke->id}}"' class="btn btn-primary">
                            Unlike 
                        </button>
                    @endif


                @endif

                <!-- BROJ LAJKOVA POVLACENJE IZ BAZE -->
                <?php
                    $lajkovi = App\likes::where('joke_id',$joke->id)->get();
                    $brojLajkova = count($lajkovi);
                ?>

                <!-- Ispis broja lajkova -->
                <button class="btn btn-primary">
                    {{$brojLajkova}}
                </button> 


            </div>

        

        @endforeach
    @else
        <div class="well" id="usredini">
            <h3>
                Trenutno nije dostupno
            </h3>
        </div>
    @endif





@endsection