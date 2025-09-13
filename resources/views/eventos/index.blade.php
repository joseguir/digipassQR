@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
     <h1>Lista de eventos</h1>
@endsection

@section('content')
    <a href="{{ route('eventos.create') }}"  class="btn btn-primary mb-3">Crear Evento</a>

     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('admin')
       <div>
          <p>Eres el admin</p>
       </div>
    @endcan

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Fecha</th>
            <th>Direccion</th>
            <th>Acciones</th>
        </tr>
     </thead>
      <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->id }}</td>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ $evento->fecha }}</td>
                    <td>{{ $evento->direccion }}</td>
                    <td>
                        <a href="{{ route('eventos.show', $evento) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este evento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
   </table>
@stop

