@extends('layouts.app')
@section('title')
@endsection
@section('content')
    <h3 style="text-align: center">
        {{ $wespecialidad }}
    </h3>
	<div class="container" align="center">
        <iframe src={{ asset("pdf/Visio-plan8" . $especialidad . ".pdf") }} width="800" height="610" ></iframe>
	</div>
@endsection

@section('style')
@endsection