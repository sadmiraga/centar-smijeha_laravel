@extends('layouts.app')

@section('content')

<?php
    $categories = App\category::all();
    
?>

    <div class="well" id="usredini">
        <h1>Posaljite novi vic </h1>
    </div>




    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    
    <div class="alert alert-info" id="usredini">
        {!! Form::open(['url' => 'posaljitevic/submit']) !!}
            <div class="form-group" id="submitform">
                {{Form::textarea('jokeText','', ['class' => 'form-control', 'placeholder'=>'Napišite vic', 'rows'=>'3', 'cols'=>'2'] )}}
                <br>
                <label> Izaberite Kategoriju vica </label>
                <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                        <option value ={{$category->id}}> {{$category->categoryName}} </option>    
                    @endforeach
                </select>
                

            </div>



            <div class="text-center">
                {{Form::submit('Pošalji',['class'=>'btn btn-primary'])}}
            </div>

            <!-- I AM NOT ROBOT -->
            <div id="nisamRobot" class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
            @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display:block">
                    <strong>{{$errors->first('g-recaptcha-response')}} </strong>
                </span>
            @endif
        {!! Form::close() !!}
    </div>
    
@endsection