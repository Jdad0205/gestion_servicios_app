@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de PQRs</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="pqr-soporteTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Cliente</th>
                <th>Solución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pqrs as $pqr)
                <tr>
                    <td>{{ $pqr->id }}</td>
                    <td>{{ $pqr->descripcion }}</td>
                    <td>{{ $pqr->tipo }}</td>
                    <td>{{ $pqr->cliente->nombre_usuario ?? 'Sin Cliente' }}</td>
                    <td>{{ $pqr->descripcion_solucion ?? 'Sin Solución' }}</td>
                    <td>
                        @if (!$pqr->descripcion_solucion)
                            <!-- Formulario para agregar la solución al PQR -->
                            <form action="{{ route('soporte.pqrs.solucionar', $pqr->id) }}" method="POST">
                                @csrf
                                <textarea name="descripcion_solucion" required placeholder="Escribe la solución aquí"></textarea>
                                <button type="submit" class="btn btn-primary">Enviar Solución</button>
                            </form>
                        @else
                            <span>Solucionado</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
