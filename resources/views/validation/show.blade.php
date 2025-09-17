@extends('adminlte::page')

@section('title', 'Validar QR')

@section('content_header')
    <h1>Validar Entrada por QR</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('validation.validate', $evento) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="qr_image">Subir imagen del QR</label>
            <input type="file" name="qr_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Validar</button>
    </form>
@stop
