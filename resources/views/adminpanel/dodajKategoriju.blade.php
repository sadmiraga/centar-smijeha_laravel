@extends('layouts.app')


@section('content')


@if(count($errors)>0)
@foreach($errors->all() as $error)
    <div id="errorMessages" class="alert alert-danger">
        {{$error}}
    </div>
@endforeach
@endif

<div class="alert alert-info" id="usredini">
        
    {!! Form::open(['url' => '/submitCategory']) !!}
    <div class="form-group" id="submitform">
        {{Form::textarea('categoryName','', ['class' => 'form-control', 'placeholder'=>'Upisite ime kategorije', 'rows'=>'3', 'cols'=>'2'] )}}
    </div>



    <div class="text-center">
        {{Form::submit('Dodaj',['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
</div>











@endsection