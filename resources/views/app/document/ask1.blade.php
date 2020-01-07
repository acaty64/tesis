@extends('layouts.app')
@section('title',{{ $data->name }})

@section('content')
[
            'name' => 'Decisión Plan de Tesis',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 3,
            'view' => 'app.document.ask1',
            'fdata' => 'dataAsk1Blade',
        ]
@endsection

@section('js')

@endsection

@section('view','app/document/ask1.blade.php')
