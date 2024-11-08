@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-info mb-3 boton-crear">Crear Cliente</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="clientesTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"onclick="return confirm('¿Estás seguro de eliminar este servicio?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
