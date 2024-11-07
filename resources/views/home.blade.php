

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sena</title>


    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    
    <script src="{{asset('js/storageTema.js')}}"></script>
</head>
<body>

        @if(session('success'))
            <script>mensajeDeExito("{{session('success')}}");</script>
        @endif
        
        @if(session('error'))
            <script>mensajeDeError("{{ session('error') }}");</script>
        @endif

        @if(session('warning'))
            <script>mensajeDeAdvertencia("{{ session('warning') }}");</script>
        @endif 


    <header>
        <h1>Gestion de servicios app</h1>
        <p>La solución innovadora para la asignación eficiente de servicios a proveedores y la gestión optimizada de recursos.</p>

    </header>
    <div class="card-container">
    <div class="card">
        <h2>Asignación Inteligente de Servicios</h2>
        <p>Con Servicios Gestion App, optimiza la asignación de servicios según la disponibilidad, tipo de solicitud y perfil del proveedor. Ahorra tiempo y evita conflictos en la programación.</p>
    </div>

    <div class="card">
        <h2>Gestión en Tiempo Real</h2>
        <p>Visualiza la disponibilidad de los servicios en tiempo real. Cambia, organiza y ajusta las asignaciones con solo unos clics a través de un panel interactivo.</p>
    </div>

    <div class="card">
        <h2>Automatización de Procesos</h2>
        <p>Automatiza tareas repetitivas y recibe notificaciones instantáneas sobre cambios en la programación de servicios. Mantén el control sin esfuerzo adicional.</p>
    </div>

    <div class="card">
        <h2>Optimización de Recursos</h2>
        <p>Asegura que cada recurso sea utilizado de manera eficiente, basándote en la disponibilidad, los requisitos técnicos y la demanda de los servicios.</p>
    </div>

    <div class="card">
        <h2>Reportes y Análisis</h2>
        <p>Obtén reportes detallados sobre el uso de los servicios y los recursos para tomar decisiones estratégicas. Con Servicios Gestion App, mejora la administración de tus servicios y optimiza tus operaciones.</p>
    </div>

    <div class="card">
        <h2>Escalable y Personalizable</h2>
        <p>Servicios Gestion App es flexible y se adapta a las necesidades de diferentes sectores, desde empresas hasta instituciones, para gestionar servicios de manera eficiente.</p>
    </div>
</div>


    <div class="action-buttons">
    <a href="{{ route('register') }}" class="register">Registrarse</a>
        <a href="{{ route('login') }}" class="login">Iniciar Sesión</a>
    </div>

    
</body>
</html>
