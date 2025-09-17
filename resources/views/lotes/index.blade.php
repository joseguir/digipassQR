@extends('adminlte::page')

@section('title', 'Lotes')

@section('content_header')
    <h1>Lista de lotes</h1>
@stop

@section('content')
    <a href="{{ route('lotes.create') }}" class="btn btn-success mb-3">Nuevo Lote</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lotes as $lote)
                        <tr>
                            <td>{{ $lote->evento->titulo }}</td>
                            <td>{{ $lote->nombre }}</td>
                            <td>{{ $lote->cantidad }}</td>
                            <td>
                                <a href="{{ route('lotes.edit', $lote->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar lote?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop