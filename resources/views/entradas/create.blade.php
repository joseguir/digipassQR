@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
     <h1>Crear Entradas</h1>
@endsection

@section('content')
    <form action="{{ route('entradas.store') }}" method="POST" class="pb-4">
        @csrf

        <div class="form-group">
            <label for="lote_id">Lote</label>
            <select name="lote_id" class="form-control" required>
                @foreach($lotes as $lote)
                    <option value="{{ $lote->id }}">
                        Lote {{ $lote->nombre }} - {{ $lote->evento->titulo }} (Precio: ${{ $lote->precio }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} - {{ $usuario->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="estado_id">Estado</label>
            <select name="estado_id" class="form-control" required>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" @if($estado->nombre === 'no_usada') selected @endif>
                        {{ ucfirst($estado->nombre) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
