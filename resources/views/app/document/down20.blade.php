@extends('layouts.app')
@section('title',{{ $data->name }})

@section('content')
[
            'name' => 'Descarga del Revisor',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'tadvisor_id' => 2,
            'view' => 'app.document.down20',
            'fdata' => 'dataDown20Blade',
        ]
@endsection

@section('js')

@endsection

@section('view','app/document/down20.blade.php')
