@extends('layouts.A4_PDF')
@section('title')
    {{ $wcurso }} ({{ $cod_curso }})
@endsection
@section('content')
	<div class="container">
		@foreach($lineas as $linea)
			{!! $linea['html'] !!}
		@endforeach
	</div>
@endsection
@section('style')
    <style>
    	.body {
            margin-top: 5%;
            margin-bottom: 5%;
    		margin-left: 10%;
    		background-color: white;
    	}

        .titulo0 {
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .titulo1 {
            font-size: 15px;
            font-weight: bold;
            margin-top: 20px;
        }

        .titulo3, .col-1.contenidos {
            text-align: center;
        }

        .unidades {
            border: 1px solid black;
        }

        .col-2.titulo3, .col-3.titulo3,  .col-4.titulo3,  .col-6.titulo3, 
        .col-2.contenidos, .col-3.contenidos, .col-4.contenidos,  .col-6.contenidos,
        .col-3.generales,
        .col-2.bibliografias, .col-3.bibliografias 
        {
            margin-left: 0px;
        }

        .sumillas,
        .competencias,
        .contenidos,
        .estrategias
        {
            text-align: justify;
        }

        .examenes {
            border: 1px solid;
            border-color: rgba(0,0,0,0.75);
            text-align: center;
        }
    </style>
@endsection