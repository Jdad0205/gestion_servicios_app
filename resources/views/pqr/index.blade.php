<!-- resources/views/pqr/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de PQRs</h1>
        <a href="{{ route('pqr.create') }}" class="btn btn-info">Crear nueva PQR</a>

        <table id="pqrTable" class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pqrs as $pqr)
                    <tr>
                        <td>{{ $pqr->id }}</td>
                        <td>{{ $pqr->cliente->nombre }}</td> <!-- Relación con el cliente -->
                        <td>{{ $pqr->tipo }}</td>
                        <td>{{ $pqr->estado }}</td>
                        <td>{{ $pqr->fecha_creacion }}</td>
                        <td>
                            <a href="{{ route('pqr.edit', $pqr->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('pqr.destroy', $pqr->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
