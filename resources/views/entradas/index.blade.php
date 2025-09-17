@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
     <h1>Lista de entradas</h1>
@endsection

@section('content')
    <a href="{{ route('entradas.create') }}" class="btn btn-success mb-3">Nueva Entrada</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Evento</th>
                <th>Lote</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Código QR</th>
                <th>Fecha Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->id }}</td>
                    <td>{{ $entrada->lote->evento->titulo }}</td>
                    <td>{{ $entrada->lote->nombre }}</td>
                    <td>{{ $entrada->usuario->name }}</td>
                    <td>{{ $entrada->estado->nombre }}</td>
                    <td>{{ $entrada->codigo_qr }}</td>
                    <td>{{ $entrada->fecha_compra }}</td>
                    <td>
                    <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('entradas.edit', $entrada) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('entradas.destroy', $entrada) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar entrada?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop