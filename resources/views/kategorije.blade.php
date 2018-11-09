@extends('layouts.app')


@section('content')

<?php
    $categories = App\category::all();
?>

    @if(count($categories)>0)
        @foreach($categories as $category)
<a href="/kategorije/{{$category->id}}">
            <div class="well" id="kategorije">
                <p>
                    {{$category->categoryName}}
                </p>
            </div>
            </a>    
        @endforeach
    @else
    <p> Nema kategorija </p>
    @endif


@endsection