@extends('layouts.app')


@section('content')
    


<?php
    $categories = App\category::all();
    $jokes = App\jokes::where('id',$joke_id)->get();
    foreach($jokes as $joke){
        $jokeValue = $joke->jokeText;
        $jokeCategoryID = $joke->category_id;
    }
?>
    {{$jokeCategoryID}}

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    
    {!! Form::open(['action'=>['jokesController@update',$joke_id],'method'=>'POST']) !!}
        <div class="form-group" id="submitform">
            {{Form::textarea('jokeText',"$jokeValue", ['class' => 'form-control', 'rows'=>'3', 'cols'=>'2'] )}}
            <select name="category_id">
                @foreach ($categories as $category)
                    @if(($category->id)==$jokeCategoryID)
                    <option selected="selected" value ={{$category->id}}> {{$category->categoryName}} </option>
                    @else 
                        <option value ={{$category->id}}> {{$category->categoryName}} </option>
                    @endif
                @endforeach
            </select>
            

        </div>

        {{Form::hidden('_method','PUT')}}

        <div class="text-center">
            {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}



















@endsection