@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Módulo de Tesis - @php echo Auth::user()->tuser @endphp</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Seleccione la opción en la barra superior.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','home.blade.php')