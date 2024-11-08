{{-- resources/views/pqr/index_cliente.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar PQR</h1>
        <div class="card p-4" style="max-width: 500px; margin: auto;">
            <form action="{{ route('pqr.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="descripcion">Escriba por favor aquí su petición, queja o reclamo</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="5" placeholder="Escriba por favor aquí su petición, queja o reclamo"></textarea>
                </div>

                <div class="d-flex justify-content-around mt-3">
                    <button type="submit" name="tipo" value="Peticion" class="btn btn-primary">Peticion</button>
                    <button type="submit" name="tipo" value="Queja" class="btn btn-primary">Queja</button>
                    <button type="submit" name="tipo" value="Reclamo" class="btn btn-primary">Reclamo</button>
                </div>
            </form>
        </div>
    </div>
@endsection
