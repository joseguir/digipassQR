@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
     <h1>Lista de entradas</h1>
@endsection

@section('content')

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

                         @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <!-- Botones Editar y Eliminar: solo admin y organizador -->
                           <!--  <a href="" class="btn btn-warning btn-sm">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form> -->
                        @elseif(auth()->user()->role_id == 3)
                            <!-- Botón Cancelar: solo clientes -->
                           <!--  <form action="{{ route('entradas.destroy', $entrada) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                            </form> -->
                        @endif 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop