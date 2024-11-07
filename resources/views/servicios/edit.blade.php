@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Servicio</h1>

    <form action="{{ route('servicios.update', $servicio) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $servicio->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" required>{{ $servicio->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="firma">Firma</label>
            <input type="text" class="form-control" name="firma" id="firma" value="{{ $servicio->firma }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
    </form>
</div>
@endsection
