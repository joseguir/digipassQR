@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT') {{-- Muy importante para que use el método PUT --}}
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password: dejar en blanco para no cambiar --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña <small class="text-muted">(dejar en blanco para no cambiar)</small></label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Rol</label>
            <select name="role_id" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $usuario->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->nombre }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

         <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
@endsection