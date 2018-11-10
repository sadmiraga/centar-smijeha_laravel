@extends('layouts.app')

@section('content')

<?php
    $categories = App\category::all();
    
?>





    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    
    {!! Form::open(['url' => 'posaljitevic/submit']) !!}
        <div class="form-group" id="submitform">
            {{Form::textarea('jokeText','', ['class' => 'form-control', 'placeholder'=>'Napišite vic', 'rows'=>'3', 'cols'=>'2'] )}}
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value ={{$category->id}}> {{$category->categoryName}} </option>    
                @endforeach
            </select>
            

        </div>



        <div class="text-center">
            {{Form::submit('Pošalji',['class'=>'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection