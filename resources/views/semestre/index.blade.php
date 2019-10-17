@extends('layouts.app')
@section('title','Semestre')

@section('content')
    <h1 class="text-center">Definición de Semestre Activo</h1>
    <form action="{{ route('semestre.create') }}" method="POST">
        {{ csrf_field() }}    
        <div class="container">
            <div class="row">        
                <div class="form-group col-md-2">   
                      <label>Semestre anterior:</label>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="semestre">
                        @foreach ($semestres as $semestre)
                            <option>{{ $semestre }}</option>
                        @endforeach
                    </select>
                </div>        
            </div>
            <div class="row">        
                <div class="form-group col-md-2">
                    <label>
                        Nuevo Semestre:
                    </label>                
                </div>
                <div class="col-md-2">
                    <input type="text" name="new_semestre" >
                </div>
            </div>
            <div class="row">        
                <div class="form-group col-md-3">
                    <button type="submit">Aceptar</button>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('js')

@endsection

@section('view','semestre/index.blade.php')
