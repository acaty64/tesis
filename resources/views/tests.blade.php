@extends('layouts.app')
@section('title')
    Blade de Prueba
@endsection
@section('content')
    <div class="container flex-center">
        <div class="content">
            <h1>
                Testing access: {{ $data }}
            </h1>
        </div>
    </div>
@endsection

@section('view','tests.blade.php')