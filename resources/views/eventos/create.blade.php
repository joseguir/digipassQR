@extends('adminlte::page')

@section('title', 'Crear Evento')

@section('content_header')
    <h1>Crear Evento</h1>
@stop

@section('content')
    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" value="{{ old('fecha') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="img">Imagen del evento</label>
            <input type="file" name="img" class="form-control" accept=".jpeg,.png,.jpg,.gif,.webp,.svg">
            <small class="text-muted">Formatos permitidos: jpeg, png, jpg, gif, webp, svg (máx. 2MB)</small>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
    