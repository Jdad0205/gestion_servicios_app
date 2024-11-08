<!-- resources/views/pqr/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar PQR</h1>

        <form action="{{ route('pqr.update', $pqr->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_cliente">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @if($cliente->id == $pqr->id_cliente) selected @endif>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="Petición" @if($pqr->tipo == 'Petición') selected @endif>Petición</option>
                    <option value="Queja" @if($pqr->tipo == 'Queja') selected @endif>Queja</option>
                    <option value="Reclamo" @if($pqr->tipo == 'Reclamo') selected @endif>Reclamo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required>{{ $pqr->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Pendiente" @if($pqr->estado == 'Pendiente') selected @endif>Pendiente</option>
                    <option value="Resuelta" @if($pqr->estado == 'Resuelta') selected @endif>Resuelta</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar PQR</button>
        </form>
    </div>
@endsection
