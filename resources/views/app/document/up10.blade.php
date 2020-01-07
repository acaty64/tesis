@extends('layouts.app')
@section('title','up10')

@section('content')

<div class="container">
	Thesis Id: {{ $data['thesis']['id'] }}
	<h3>{{ $data['deal']['name'] }}</h3>
	<form action="{{ route('document.up10') }}" enctype="multipart/form-data" method="post">
		{{ csrf_field() }}
		<input type="hidden" id="thesis_id" name="thesis_id" value="{{ $data['thesis']['id'] }}">
		<input type="hidden" id="deal_id" name="deal_id" value="{{ $data['deal']['id'] }}">
		<input type="hidden" id="author_id" name="author_id" value="{{ $data['author_id'] }}">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<label>Seleccione su archivo (sólo Microsoft Word): </label>
					<div class="form-group files">
						<input type="file" 
						name="file" 
						class="form-control"
						accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
						>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-sm btn-primary">Grabar</button>
		</div>		
	</form>	
</div>	
@endsection

@section('style')
<style>
	.files input {
		outline: 2px dashed #92b0b3;
		outline-offset: -10px;
		-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
		transition: outline-offset .15s ease-in-out, background-color .15s linear;
		padding: 120px 0px 85px 35%;
		text-align: center !important;
		margin: 0;
		width: 100% !important;
	}
	.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
		-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
		transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
	}
	.files{ position:relative}
	.files:after {  pointer-events: none;
		position: absolute;
		top: 60px;
		left: 0;
		width: 50px;
		right: 0;
		height: 56px;
		content: "";
		background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
		display: block;
		margin: 0 auto;
		background-size: 100%;
		background-repeat: no-repeat;
	}
	.color input{ background-color:#f1f1f1;}
	.files:before {
		position: absolute;
		bottom: 10px;
		left: 0;  pointer-events: none;
		width: 100%;
		right: 0;
		height: 57px;
		content: " or drag it here. ";
		display: block;
		margin: 0 auto;
		color: #2ea591;
		font-weight: 600;
		text-transform: capitalize;
		text-align: center;
	}
</style>
@endsection

@section('view')
	{{ $data['deal']['view'] }}
@endsection
