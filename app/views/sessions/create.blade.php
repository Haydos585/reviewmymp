@extends('templates.application')
  @section('content')
    <h2>Login</h2>
    {{ Form::open(array("action" => "SessionController@store", "class" => "small-6", "role" => "form")) }}
      {{ Form::label('email') }}
      {{ Form::text('email') }}

      {{ Form::label('password') }}
      {{ Form::password('password') }}

      {{ Form::button('Log in', array('class' => 'button success', 'type' => 'submit')) }}
    {{ Form::close() }}
  @stop