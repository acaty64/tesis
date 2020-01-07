@extends('layouts.app')

@section('content')
	@if(count($data)==0)
		No hay documentos por revisar
	@endif

	<table class="table table-striped" style="width:80%; border-style: solid;" align="center">
		<thead>
			<tr>
				<th>Id</th>
				<th>Título</th>
				<th>Autor</th>
				<th>Tipo</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
				<tr>
					<td>{{ $item['id'] }}</td>
					<td>{{ $item['title'] }}</td>
					<td>{{ $item['author'] }}</td>
					<td>{{ $item['tadvisor'] }}</td>
					<td class="text-center"><a href="">Editar</a></td>
					{{-- <td class="text-center"><a href="{{ route('app.advisor.show',[$item['id'], $item['user_id']]) }}">Editar</a></td> --}}
				</tr>
			@endforeach
		</tbody>
	</table>


@endsection

@section('js')

@endsection

@section('view','app/thesis/advisor.blade.php')
