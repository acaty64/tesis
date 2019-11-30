@extends('layouts.app')
@section('title','Tesis')

@section('content')
    <h1 class="text-center">Mantenimiento de Datos de Tesis</h1>
    <table style="width:50%" align="center">
    	<tr>
			<p style="text-align:center;">
                <a href="{{ route('thesis.create') }}" class="btn btn-success" data-toggle="tooltip">Crear Nuevo Registro</a>
			</p>
    	</tr>
    </table>
	<table style="width:80%; border-style: solid;" align="center">
		{{ csrf_field() }}
		<tr class="row">
			<th>Id</th>
			<th>Correlativo</th>
			<th>Solicitud</th>
			<th>Autor</th>
			<th>Titulo</th>
			<th>Acción</th>
		</tr>
		@foreach($data as $item)
			<tr class="row" style="border-style: solid;">
				<td>{{ $item->id }}</td>
				<td>{{ $item->serie }}</td>
				<td>{{ $item->application }}</td>
				<td>{{ $item->author }}</td>
				<td>{{ $item->title }}</td>
				<td>
					<a href="{{ route('thesis.destroy', $item->id) }}" class="btn btn-danger" data-toggle="tooltip" title="Eliminar" ><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
					<a href="{{ route('thesis.edit', $item->id) }}" class="btn btn-success" data-toggle="tooltip" title="Editar Datos" ><span class="glyphicon glyphicon-pencil" aria-hidden='true'></span></a>
					<a href="{{ route('thesis.email', $item->id) }}" class="btn btn-success" data-toggle="tooltip" title="Envio de Correo" ><span class="glyphicon glyphicon-send" aria-hidden='true'></span></a>
				</td>
			</tr>
		@endforeach
	</table>
    <div class="pages">
        {{ $data->links() }}
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
@section('view','app/thesis/index.blade.php')