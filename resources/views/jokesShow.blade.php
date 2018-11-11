
@extends('layouts.app')

@section('content')

<?php 

     $jokes = App\jokes::orderBy('id','desc')->get();
     $userID = Auth::id();
     $likes = App\likes::where('user_id',$userID)->get();
?>


    

    @if(count($jokes)>0)

        @foreach($jokes as $joke)
            <div class="alert alert-info">
                <!-- text vica -->
                <p style="text-align:center;">
                        {{$joke->jokeText}}
                    <br>  
                </p>


                @if($juzer = Auth::user())
                    <?php
                        $likeCount = App\likes::where([
                        'user_id' => $userID,
                        'joke_id' => $joke->id
                        ])->get();
                    ?>

                    

                    @if(count($likeCount)==0)
                        <a href="/like/{{$joke->id}}">
                            <button id="likeUnlikeButton" class="btn btn-primary">
                                Like
                            </button>
                        </a>
                    @else
                        <a href="/unlike/{{$joke->id}}">
                            <button id="likeUnlikeButton" class="btn btn-primary">
                                Unlike
                            </button>
                        </a>
                    @endif
                @endif

            </div>


        @endforeach
    @else
            <p> Nema viceva </p>
    @endif


    


@endsection


