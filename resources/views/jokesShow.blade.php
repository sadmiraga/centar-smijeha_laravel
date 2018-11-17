
@extends('layouts.app')

@section('content')

<?php 

     $jokes = App\jokes::where('approve','yes')->orderBy('id','desc')->get();
     $userID = Auth::id();
     $likes = App\likes::where('user_id',$userID)->get();
?>
    


    

    @if(count($jokes)>0)

        @foreach($jokes as $joke)

            <!--SELECT USERNAME OF AUTHOR-->
        <?php
            $users = App\User::where('id',$joke->user_id)->get();

            //pokupis vrijednost USERNAMEA
            foreach($users as $user){
                $username = $user->name;
            }
        ?>


        
            
            <!-- TEXT VICA -->
            <div class="alert alert-info" id="vic">
                <!-- text vica -->
                <p style="text-align:center;" id="textVica">
                        {{$joke->jokeText}}
                </p>
                <span id="imeAutora"> 
                    {{$username}}
                </span>
                        
                


                <!-- provjeriti da li je user prijavljen i shodno tome ispisati like i unlike button -->
                @if($juzer = Auth::user())
                    <?php
                        $likeCount = App\likes::where([
                        'user_id' => $userID,
                        'joke_id' => $joke->id
                        ])->get();
                    ?>

                    <div id="usredini">  
                        <!-- LIKE -->
                        @if(count($likeCount)==0)
                            <a href="/like/{{$joke->id}}">
                                <button  class="btn btn-primary">
                                    Like
                                </button>
                            </a>
                        <!--UNLIKE -->
                        
                        @else
                            <a href="/unlike/{{$joke->id}}">
                                <button  class="btn btn-primary">
                                    Unlike
                                </button>
                            </a>
                        @endif

                        <!--BROJ LAJKOVA -->
                        <?php
                            $lajkovi = App\likes::where('joke_id',$joke->id)->get();
                            $brojLajkova = count($lajkovi);
                        ?>
                        
                        
                        <button class="btn btn-primary">
                        {{$brojLajkova}}
                        </button>
                    </div>

                @endif

            </div>


        @endforeach
    @else
            <p> Nema viceva </p>
    @endif


    


@endsection


