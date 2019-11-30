@extends('layouts.app')
@section('title','Usuarios')

@section('content')
    <h1 class="text-center">Mantenimiento de Datos de Usuarios</h1>
    <table style="width:50%" align="center">
    	<tr>
			<p style="text-align:center;">
                <!--a href="{{ route('users.create') }}" class="btn btn-success" data-toggle="tooltip">Crear Usuario</a-->
			</p>
    	</tr>
    </table>
	<table style="width:80%; border-style: solid;" align="center">
		{{ csrf_field() }}
		<tr class="row">
			<th>Id</th>
			<th>Código</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Acción</th>
		</tr>
			
		@foreach($users as $user)
			<tr class="row" style="border-style: solid;">
				<td>{{ $user->id }}</td>
				<td>{{ $user->userDetail->codigo }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->tuser }}</td>
				<td>
					<a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger" data-toggle="tooltip" title="Eliminar" ><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" data-toggle="tooltip" title="Editar Datos" ><span class="glyphicon glyphicon-pencil" aria-hidden='true'></span></a>
				</td>
			</tr>
		@endforeach
	</table>
    <div class="pages">
        {{ $users->links() }}
    </div>
@endsection

@section('style')
    <style>
        th {
            text-align: center;
        }
        .pages {
            text-align: center;
        }
    </style>
@endsection
@section('view','app/users.blade.php')