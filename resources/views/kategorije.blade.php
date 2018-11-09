@extends('layouts.app')


@section('content')

<?php
    $categories = App\category::all();
?>

    @if(count($categories)>0)
        @foreach($categories as $category)
            <p>
                {{$category->categoryName}}
                {{$category->id}}
            </p>
        @endforeach
    @endif


@endsection