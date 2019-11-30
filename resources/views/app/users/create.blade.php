@extends('layouts.app')
@section('title','Crear Nuevo Usuario')

@section('content')
	{!! Form::open(['route'=>'users.store', 'method'=>'POST']) !!}
	{!! csrf_field() !!}
	{!! Field::text('name') !!}
	{!! Field::email('email') !!}
	{!! Field::password('password') !!}
	{!! Field::password('password_confirmation') !!}
	{!! Form::submit('Send', ['class' => 'btn btn-success']) !!}
	{!! Form::close() !!}
@endsection

@section('js')

@endsection

@section('view','app/users/create.blade.php')
