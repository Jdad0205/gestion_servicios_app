<!-- resources/views/pqr/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nueva PQR</h1>

        <form action="{{ route('pqr.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_cliente">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    <option value="">Selecciona un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="Petición">Petición</option>
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Resuelta">Resuelta</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar PQR</button>
        </form>
    </div>
@endsection
