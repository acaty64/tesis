@extends('layouts.app')
@section('title','Editar Usuario')

@section('content')
<form action="{{ route('users.update') }}" method="POST">
	{{ csrf_field() }}
	<h1>Edición de Usuario</h1>
	<button type="submit">
		Grabar modificaciones
	</button>
	<br>
	<br>
	<input type="hidden" name="id" value="{{ $user->id }}">
	<div class="form-group">
    	<label for="name">Nombres y Apellidos</label>
		<input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
  	</div>
	<div class="form-group">
    	<label for="email">Correo Electrónico</label>
		<input type="email" class="form-control" name="email" id="email" class="email" value="{{ $user->email }}">
  	</div>
	<div class="form-group">
    	<label for="cod_doc">Código Docente</label>
		<input type="text" class="form-control" name="cod_doc" id="cod_doc" class="cod_doc" value="{{ $user->cod_doc }}">
  	</div>
	<div class="form-group">
    	<label for="password">Nuevo Password</label>
		<input type="text" class="form-control" name="password" id="password" class="password" value="">
  	</div>
	<div class="form-group">
    	<label for="confirm">Confirme el Nuevo Password</label>
		<input type="text" class="form-control" name="confirm" id="confirm" class="password" value="">
  	</div>
    
	<div class="form-group">
	    <label for="acceso_id">Acceso</label>
		<select name="acceso_id" class="form-control" id="acceso_id">
			@foreach($accesos as $acceso)
				<option value={{ $acceso->id }} {{ ($user->acceso->id === $acceso->id) ? 'selected' : ''}} >{{ $acceso->wacceso }}</option>
			@endforeach
		</select>
	</div>
</form>
@endsection

@section('js')

@endsection

@section('view','app/users/create.blade.php')
