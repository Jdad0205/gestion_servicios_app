@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Facturas</h1>
    <a href="{{ route('facturas.create') }}" class="btn btn-primary mb-3 boton-crear">Crear Factura</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="facturasTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Contrato</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <td>{{ $factura->id }}</td>
                    <td>{{ $factura->cliente->nombre }}</td>
                    <td>{{ $factura->contrato->descripcion }}</td>
                    <td>{{ $factura->fecha_emision }}</td>
                    <td>{{ $factura->total_pagar }}</td>
                    <td>
                        <a href="{{ route('facturas.edit', $factura) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('facturas.destroy', $factura) }}" method="POST" style="display:inline;">
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
