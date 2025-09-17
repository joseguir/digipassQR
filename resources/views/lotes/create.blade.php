@extends('adminlte::page')

@section('title', 'Crear Lote')

@section('content_header')
    <h1>Crear Lote</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('lotes.store') }}" method="POST">
           @csrf

           <div class="form-group">
                <label for="evento_id">Evento</label>
                <select name="evento_id" id="evento_id" class="form-control" required>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del Lote</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad de Entradas</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required min="1">
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('lotes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop