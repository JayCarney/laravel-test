
@extends('layouts.bootstrap')

@section('content')
  {{ Form::open(['route'=>'sessions.store','class'=>'form-signin']) }}
    <div>
        {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email Address','required'=>'required']) }}
    </div>
    <div>
    {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password','required'=>'required']) }}
    </div>
    <div>
    {{ Form::submit('Login', ['class'=>'btn btn-lg btn-primary btn-block']) }}
    </div>
  {{ Form::close() }}
@endsection