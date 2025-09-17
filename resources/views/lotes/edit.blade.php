@extends('adminlte::page')

@section('title', 'Editar Lote')

@section('content_header')
    <h1>Editar Lote</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('lotes.update', $lote->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="evento_id">Evento</label>
                <select name="evento_id" id="evento_id" class="form-control" required>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}" {{ $evento->id == $lote->evento_id ? 'selected' : '' }}>
                            {{ $evento->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del Lote</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $lote->nombre }}" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad de Entradas</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $lote->cantidad }}" required min="1">
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                value="{{ $lote->fecha_inicio ? $lote->fecha_inicio->format('Y-m-d') : '' }}">
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"   
                value="{{ $lote->fecha_fin ? $lote->fecha_fin->format('Y-m-d') : '' }}">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('lotes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
