@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content_header')
    <h1>Editar Evento</h1>
@stop

@section('content')
    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $evento->titulo) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $evento->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d\TH:i') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Lugar</label>
            <input type="text" name="direccion" value="{{ old('direccion', $evento->direccion) }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="img">Imagen actual</label><br>
            @if($evento->img && file_exists(public_path($evento->img)))
                <img src="{{ asset($evento->img) }}" alt="Imagen del evento" class="img-thumbnail mb-2" style="max-width: 200px;">
            @else
                <p class="text-muted">No hay imagen cargada.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="img">Subir nueva imagen</label>
            <input type="file" name="img" class="form-control">
            <small class="text-muted">Formatos permitidos: jpeg, png, jpg, gif, webp, svg (máx. 2MB)</small>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
