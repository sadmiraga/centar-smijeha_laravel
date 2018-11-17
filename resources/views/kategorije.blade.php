@extends('layouts.app')


@section('content')

<?php
    $categories = App\category::all();
?>
    <div class="well" id="usredini">
        <h1> Kategorije </h1>
    </div>

    <!-- Najbolji vicevi kategorija -->
    <button onclick='location.href="/najboljiVicevi"' class="btn btn-primary" id="dugmeKategorije">
        Top Vicevi 
    </button>

    <!-- ispis svih kategorija -->
    @if(count($categories)>0)
        @foreach($categories as $category)
                <button onclick='location.href="/kategorije/{{$category->id}}"' class="btn btn-primary" id="dugmeKategorije">
                        {{$category->categoryName}}
                </button>
            <br>
        @endforeach
    @else
    <p> Nema kategorija </p>
    @endif


@endsection