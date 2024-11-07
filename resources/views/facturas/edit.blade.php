@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Factura</h1>

    <form action="{{ route('facturas.update', $factura) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select class="form-control" name="cliente_id" id="cliente_id" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $factura->cliente_id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="servicio_id">Servicio</label>
            <select class="form-control" name="servicio_id" id="servicio_id" required>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}" {{ $servicio->id == $factura->servicio_id ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $factura->fecha }}" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" class="form-control" name="monto" id="monto" value="{{ $factura->monto }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
    </form>
</div>
@endsection
