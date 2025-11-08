@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
     <h1>Lista de entradas</h1>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

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
                        <!-- Botón Ver: todos los usuarios -->
                        <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-info btn-sm">Ver Entrada</a>

                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop