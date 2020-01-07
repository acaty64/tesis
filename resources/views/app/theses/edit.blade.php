@extends('layouts.app')
@section('title',"editThesis")

@section('content')
<br>
<div class="container">
	<form action="{{ route('thesis.update') }}" method="POST">
		{{ csrf_field() }}
		<input type="hidden" id="thesis_id" name="thesis_id" value={{ $data['thesis']->id }}>
		<input type="hidden" id="oldAuthor_id" name="oldAuthor_id" value={{ $data['thesis']['authorId'] }}>
		<span class="row">				
			<span class="col-md-3">			
				<div class="input-group">
					<span class="input-group-addon" id="serie">Correlativo</span>
					<input type="text" class="form-control" name="serie" required maxlength="30" placeholder="Número de solicitud" value="{{ $data['thesis']->serie }}" readonly>
				</div>
			</span>
		</span>
		<span class="row">				
			<span class="col-md-3">			
				<div class="input-group">
					<span class="input-group-addon" id="application">Solicitud</span>
					<input type="text" class="form-control" name="application" required maxlength="30" placeholder="Número de solicitud" value="{{ $data['thesis']->application }}">
				</div>
			</span>
		</span>
		<span class="row">				
			<span class="col-md-8">			
				<div class="input-group">
					<span class="input-group-addon" id="author">Autor</span>
						<select class="custom-select" name="author_id" id="author_id" required>
							@foreach($data['authors'] as $item)
								<option value="{{ $item['id'] }}" {{ ( $item['id'] == $data['authorId'] ? "selected":"") }}>{{ $item['name'] }}</option>
							@endforeach
						</select>
				</div>
			</span>
		</span>
		<span class="row">
			<span class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon" id="title">Título</span>
					<input type="text" class="form-control" name="titulo" required maxlength="250" placeholder="Titulo de tesis" value="{{ $data['thesis']->title }}" readonly>
				</div>
			</span>
		</span>
		<div class="form-group">
			<button type="submit" class="btn btn-sm btn-primary">Grabar</button>
		</div>
	</form>
</div>
@endsection

@section('js')

@endsection

@section('view','app/thesis/edit.blade.php')
