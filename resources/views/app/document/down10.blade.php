@extends('layouts.app')
@section('title',{{ $data->name }})

@section('content')
{{ [
            'name' => 'Descarga de Plan de Tesis',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'blade' => 'app.document.down10',
        ]}}
@endsection

@section('js')

@endsection

@section('view','app/document/down10.blade.php')
