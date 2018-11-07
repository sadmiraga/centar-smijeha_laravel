
@extends('layouts.app')

@section('content')

<?php 

    $jokes = App\jokes::all();
    if(count($jokes)>1){

     foreach($jokes as $joke){
        echo '<div class="alert alert-info">';
            echo '<p style="text-align:center;">';
                echo $joke->jokeText;
            echo '</p>';
        echo '</div>';
    }

    } else{
        echo '<p> No jokes </p>';
    }
?>

@endsection


