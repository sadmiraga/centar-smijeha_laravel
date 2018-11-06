
@extends('layouts.app');

@section('content')

<?php 

    $jokes = App\jokes::all();

    foreach($jokes as $joke){
        echo $joke->jokeText;
        echo '<br>';
    }

?>

@endsection