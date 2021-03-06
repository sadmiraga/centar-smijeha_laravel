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
    

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif


    <div class="well" id="usredini">
    {!! Form::open(['action'=>['jokesController@update',$joke_id],'method'=>'POST']) !!}
        <div class="form-group" id="submitform">
            {{Form::textarea('jokeText',"$jokeValue", ['class' => 'form-control', 'rows'=>'10', 'cols'=>'2'] )}}
            <br>

            <!-- DROPDOWN -->
            <select class="form-control" name="category_id">
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
    </div>


















@endsection