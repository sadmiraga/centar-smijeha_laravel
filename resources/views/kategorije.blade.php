@extends('layouts.app')


@section('content')

<?php
    $categories = App\category::all();
?>
    <div class="well" id="usredini">
        <h1> Kategorije </h1>
    </div>

    @if(count($categories)>0)
        @foreach($categories as $category)
            
            
            <a href="/kategorije/{{$category->id}}">
                <button class="btn btn-primary" id="dugmeKategorije">
                    <p>
                        {{$category->categoryName}}
                    </p>
                </button>
            </a>
            <br>
            
        @endforeach
    @else
    <p> Nema kategorija </p>
    @endif


@endsection