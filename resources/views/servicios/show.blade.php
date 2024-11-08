{{-- resources/views/servicios/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Servicio</h1>
        
        <div class="mb-3">
            <strong>Nombre:</strong> {{ $servicio->nombre }}
        </div>
        
        <div class="mb-3">
            <strong>Descripción:</strong> {{ $servicio->descripcion }}
        </div>
        
        <div class="mb-3">
            <strong>Precio:</strong> {{ $servicio->precio }}
        </div>

        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">Eliminar</button>
        </form>
    </div>
@endsection
