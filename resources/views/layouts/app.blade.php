<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de servicios</title>

    <!-- Favicon básico -->
    <link rel="icon" href="{{ asset('img/asdf.png') }}" type="image/x-icon">

    @include('partials.estilos')
    @yield('estilos')
</head>

<body>

    <header class="barra-navegacion">
        <div>

            <!-- Botón para alternar la barra lateral -->
            <button id="alternarBarraLateral" class="btn btn-light">☰</button>

            <!-- Botón para volver atrás -->
            <button class="btn btn-light" onclick="goBack()" aria-label="Volver atrás">
                <i class="bi bi-arrow-left"></i> <!-- Flecha hacia atrás de Bootstrap Icons -->
            </button>
        </div>


        <!-- Título dinámico -->
        <div>
            <h2 id="titulo-pagina">@yield('titulo', '')</h2>
        </div>

        <!-- Menú de perfil -->
        <div class="dropdown" style="position: relative;">
            <button class="btn btn-light dropdown-toggle" type="button" id="menuPerfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuPerfil">
                <button class="dropdown-item">

                    <a href="" style="text-decoration: none; color: inherit;" class="btn btn-success">Ajustes</a>
                </button>
                <div class="dropdown-divider"></div>
                <button id="modoOscuroToggle" class="dropdown-item">Cambiar Tema <br> (experimental)</button>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Barra lateral -->

    <div class="barra-lateral" id="barraLateral">

        <h2>
            <img class="icono-barra-lateral" src="{{asset('img/logo.png')}}" style="width: 100px; margin: auto;" alt="Logo de app">
        </h2>
        @auth
        @if(auth()->user()->id_rol == '1')
        <a href="{{ route('dashboard') }}" class="opcion-barra-navegacion {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> <span class="texto-barra-lateral">Dashboard</span>
        </a>
        <a href="{{ route('usuarios.index') }}" class="opcion-barra-navegacion {{ Request::is('usuarios*') ? 'active' : '' }}">
            <i class="bi bi-person"></i> <span class="texto-barra-lateral">Usuarios</span>
        </a>
        <a href="{{ route('productos.index') }}" class="opcion-barra-navegacion {{ Request::is('productos*') ? 'active' : '' }}">
            <i class="bi bi-box"></i> <span class="texto-barra-lateral">Productos</span>
        </a>
        <a href="{{ route('facturas.index') }}" class="opcion-barra-navegacion {{ Request::is('facturas*') ? 'active' : '' }}">
            <i class="bi bi-file-text"></i><span class="texto-barra-lateral">Facturas</span>
        </a>
        <a href="{{ route('productos.index') }}" class="opcion-barra-navegacion {{ Request::is('productos*') ? 'active' : '' }}">
            <i class="bi bi-box"></i> <span class="texto-barra-lateral">Productos</span>
        </a>
        @elseif(auth()->user()->id_rol == '2')
        <a href="{{ route('productos.index_cliente') }}" class="opcion-barra-navegacion {{ Request::is('productos*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i>
            <span class="texto-barra-lateral">Productos</span>
        </a>
        <a href="{{ route('servicios.index_cliente') }}" class="opcion-barra-navegacion {{ Request::is('servicios*') ? 'active' : '' }}">
        <i class="bi bi-box"></i> 
        <span class="texto-barra-lateral">Servicios</span>
        </a>
        <a href="{{ route('pqr.index_cliente') }}" class="opcion-barra-navegacion {{ Request::is('pqr*') ? 'active' : '' }}">
            <i class="bi bi-envelope-exclamation"></i>
            <span class="texto-barra-lateral">PQR</span>
        </a>
        @elseif(auth()->user()->id_rol == '3')
        <a href="{{ route('pqr.index_soporte') }}" class="opcion-barra-navegacion {{ Request::is('pqr*') ? 'active' : '' }}">
            <i class="bi bi-envelope-exclamation"></i>
            <span class="texto-barra-lateral">PQR</span>
        </a>
        @endif
        @endauth





    </div>


    <!-- Contenido principal -->
    <section class="contenido" id="contenido">
        <div class="contenido-principal">

            <div class="seccionEstatus">
                @yield('estados')
            </div>
            @yield('content')

            @if(session('success'))
            <script>
                mensajeDeExito("{{session('success')}}");
            </script>
            @endif

            @if(session('error'))
            <script>
                mensajeDeError("{{ session('error') }}");
            </script>
            @endif

            @if(session('warning'))
            <script>
                mensajeDeAdvertencia("{{ session('warning') }}");
            </script>
            @endif


        </div>
    </section>

    @include('partials.scripts')
    <!-- Sección para incluir scripts adicionales en vistas específicas -->

    @stack('scripts')
    @yield('scripts')

</body>

</html>