{{-- resources/views/servicios/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servicios</h1>
        <a href="{{ route('servicios.create') }}" class="btn btn-info mb-3">Nuevo Servicio</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>{{ $servicio->precio }}</td>
                        <td>
                            <a href="{{ route('servicios.show', $servicio) }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este servicio?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
