@extends('layouts.app')
@section('title',"author")

@section('content')
<div class="container">
	<form action="{{ route('thesis.store') }}" method="POST">
		{{ csrf_field() }}
		<span class="row">				
			<span class="col-md-3">			
				<div class="input-group">
					<span class="input-group-addon" id="application">Solicitud</span>
					<input type="text" class="form-control" name="application" required maxlength="30" placeholder="Número de solicitud" value="{{ old('application') }}">
				</div>
			</span>
		</span>
		<span class="row">				
			<span class="col-md-6">			
				<div class="input-group">
					<span class="input-group-addon" id="author">Autor</span>
					{{-- <span class="input-group-addon" id="author"> --}}
						<select class="custom-select" name="author_id" id="author_id" required>
							<option selected value="0">Seleccione...</option>
							@foreach($data['authors'] as $item)
								<option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
							@endforeach
						</select>
					{{-- </span> --}}
				</div>
			</span>
		</span>
		<span class="row">
			<span class="col-md-8">			
				<div class="input-group">
					<span class="input-group-addon" id="title">Título</span>
					<input type="text" class="form-control" name="title" required maxlength="250" placeholder="Título de la tesis" value="{{ old('title') }}">
				</div>
			</span>
		</span>
		<div class="form-group">
			<button type="submit" class="btn btn-sm btn-primary">Grabar</button>
		</div>
	</form>
</div>


{{-- {{ [
			'name' => 'Ingreso de Datos para acceso al módulo',
            'tdeal_id' => 1,
            'tuser_id' => 2,
            'blade' => 'app.document.author',
            'email_id' => 1,
		] }} --}}

@endsection

@section('js')

@endsection

@section('view','app/document/author.blade.php')
