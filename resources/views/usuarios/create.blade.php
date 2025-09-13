@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1>Crear Usuario</h1>
@endsection

@section('content')
    <div class="container">
        <div class="card">
           <div class="card-body">
               {{-- Mostrar errores de validación --}}
               @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
               @endif

               <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                
                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" require>
                    </div>

                     {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" require>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" require>
                    </div>

                    {{-- Rol --}}
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Rol</label>
                        <select name="role_id" class="form-control" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }} {{ old('role_id') == $rol->id ? 'selected' : '' }}">
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>

           </div>
        </div>
    </div>
@endsection