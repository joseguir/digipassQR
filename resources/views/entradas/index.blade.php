@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
     <h1>Lista de entradas</h1>
@endsection

@section('content')
   <livewire:entradas-listado />
@stop