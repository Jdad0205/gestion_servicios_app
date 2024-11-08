{{-- resources/views/productos/index_cliente.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Productos Disponibles</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>

                            <!-- Formulario para solicitar el producto -->
                            <form action="{{ route('productos.solicitar', $producto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Solicitar producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $productos->links() }}
        </div>
    </div>
@endsection