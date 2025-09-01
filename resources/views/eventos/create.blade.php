@extends('adminlte::page')

@section('title', 'Crear Evento')

@section('content_header')
    <h1>Crear Evento</h1>
@stop


@section('content')
    <form action="{{ route('eventos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@stop