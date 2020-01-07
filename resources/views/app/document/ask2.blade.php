@extends('layouts.app')
@section('title',{{ $data->name }})

@section('content')
[
            'name' => 'Decisión sobre el Avance',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 1,
            'view' => 'app.document.ask2',
            'fdata' => 'dataAsk2Blade',
        ]
@endsection

@section('js')

@endsection

@section('view','app/document/ask2.blade.php')
