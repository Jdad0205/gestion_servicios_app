{{-- resources/views/servicios/index_cliente.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servicios Disponibles</h1>

        <div class="row">
            @foreach($servicios as $servicio)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $servicio->nombre }}</h5>
                            <p class="card-text">{{ $servicio->descripcion }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($servicio->precio, 2) }}</p>

                            <!-- Formulario para solicitar el servicio -->
                            <form action="{{ route('servicios.solicitar', $servicio->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Solicitar servicio</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $servicios->links() }}
        </div>
    </div>
@endsection
