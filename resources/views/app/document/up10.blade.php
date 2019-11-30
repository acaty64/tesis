@extends('layouts.app')
@section('title',{{ $data->name }})

@section('content')
{{ [
			'name' => 'Carga de Plan de Tesis',
            'tdeal_id' => 3,
            'tuser_id' => 3,
            'blade' => 'app.document.up10',
            'email_id' => 2,
		]}}
@endsection

@section('js')

@endsection

@section('view','app/document/up10.blade.php')
