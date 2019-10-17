@extends('layouts.app')
@section('title','Backup')

@section('content')
    <h1 class="text-center">Backup & Restore</h1>
    <table style="width:50%" align="center">
    	<tr>
			<p style="text-align:center;">
			    <button type="submit" style="float:none;">
			    	<a href="{{ route('backup.create') }}">
			    		Crear backup
			    	</a>
			    </button>
			</p>
    	</tr>
		<tr style="border-style: solid;">
			<th>Archivo</th>
			<th>Tamaño</th>
			<th>Modificado</th>
			<th>Acción</th>
		</tr>
        {{ csrf_field() }}
        @foreach($data as $fila)
            <tr style="border-style: solid;">
                <td>{{ $fila['nombre'] }}</td>
                <td>{{ $fila['tamaño'] }}</td>
                <td>{{ $fila['modificado'] }}</td>
                <td>
                    <a href="{{ route('backup.destroy', [$fila['nombre']]) }}" class="btn btn-danger" data-toggle="tooltip"><span class="glyphicon glyphicon-remove" aria-hidden='true'></span></a>
                    <!--a href="{{ route('backup.restore', [$fila['nombre']]) }}" class="btn btn-success" data-toggle="tooltip"><span class="glyphicon glyphicon-upload" aria-hidden='true'></span></a-->
                    <a href="{{ route('backup.download', [$fila['nombre']]) }}" class="btn btn-success" data-toggle="tooltip"><span class="glyphicon glyphicon-download-alt" aria-hidden='true'></span></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('js')

@endsection

@section('view','backup/index.blade.php')
