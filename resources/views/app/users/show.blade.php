@extends('layouts.app')
@section('title','Crear Nuevo Usuario')

@section('content')
	{!! Field::text('Nombre', $user->name) !!}
	{!! Field::text('Email', $user->email) !!}
	{!! Field::text('Celular', $user->userDetail->fono) !!}
	{!! Field::text('Código', $user->userDetail->codigo) !!}
	{!! Field::text('Tipo', $user->tuser) !!}
@endsection

@section('js')

@endsection

@section('view','app/users/create.blade.php')
