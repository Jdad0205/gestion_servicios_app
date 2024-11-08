<!-- resources/views/productos/index_cliente.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Productos Disponibles</h2>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Muestra la imagen si tienes una columna 'imagen' en la tabla productos -->
                        @if(isset($producto->imagen))
                            <img src="{{ asset('img/productos/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                            <p class="card-text">Precio: ${{ number_format($producto->precio, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
