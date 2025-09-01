@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content_header')
    <h1>Editar Evento</h1>
@stop

@section('content')
    <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="{{ $evento->titulo }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $evento->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d\TH:i') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Lugar</label>
            <input type="text" name="direccion" value="{{ $evento->direccion }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop