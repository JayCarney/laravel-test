@extends('layouts.bootstrap')

@section('content')
  {{ Form::open(['route'=>'users.store', 'class'=>'form-signin']) }}
        <div>
           {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email Address','required'=>'required']) }}
        </div>
        <div>
           {{ Form::text('name', null, ['class'=>'form-control form-control--mid', 'placeholder'=>'Alex Smith','required'=>'required']) }}
        </div>
        <div>
            {{ Form::password('password', ['class'=>'form-control form-control--mid', 'placeholder'=>'Password','required'=>'required']) }}
        </div>
        <div>
            {{ Form::password('password_confirm', ['class'=>'form-control', 'placeholder'=>'Password again','required'=>'required']) }}
        </div>
        <div>
            {{ Form::submit('Login', ['class'=>'btn btn-lg btn-primary btn-block']) }}
        </div>
  {{ Form::close() }}
@endsection