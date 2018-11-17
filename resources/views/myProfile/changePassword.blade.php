@extends('layouts.app')

@section('content')

<div class="well" id="usredini">
    <h1>
        Promjeni lozinku
    </h1>
</div>



@if (session('error'))
<div id="errorMessages" class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
    <div id="errorMessages" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <!-- ERRORI -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div id="errorMessages" class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif

<div class="well" id="usredini">
    {!! Form::open(['action'=>'profileController@changePasswordSubmit','method'=>'POST']) !!}


        <!-- TRENUTNI PASSWORD -->
        {{Form::password('currentPassword', array('placeholder'=>'Unesite trenutnu lozinku', 'class'=>'form-control'))}}
        <br>

        <!-- NOVI PASSWORD -->
        {{Form::password('newPassword', array('placeholder'=>'Unesite novu lozinku', 'class'=>'form-control'))}}
        <br>

        <!-- RETYPE NOVI PASSWORD -->
        {{Form::password('newPasswordCheck', array('placeholder'=>'Ponovo unesite novu lozinku', 'class'=>'form-control'))}}

        <br>
        <!-- SUBMIT -->
        {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}

    {!! Form::close()!!}
</div>

@endsection