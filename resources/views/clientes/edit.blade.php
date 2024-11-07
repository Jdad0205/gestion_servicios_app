@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indica que es una actualización -->

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" value="{{ old('correo', $cliente->correo) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}" required>
        </div>

        <div class="form-group">
            <label for="detalle">Detalle</label>
            <input type="text" class="form-control" name="detalle" id="detalle" value="{{ old('detalle', $cliente->detalle) }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar cambios</button>
    </form>
</div>
@endsection
