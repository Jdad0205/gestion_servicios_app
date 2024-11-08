<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

</head>
<body>
<div class="contenedor-registro">
    <h1>Registro</h1>
    
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Nombre del usuario -->
        <div>
            <label for="nombre_usuario">Nombre Completo</label>
            <input 
                id="nombre_usuario" 
                type="text" 
                name="nombre_usuario" 
                value="{{ old('nombre_usuario') }}" 
                required 
                autofocus 
                placeholder="Ingresa tu nombre completo"
            >

        </div>

        <!-- Correo Electrónico -->
        <div>
            <label for="correo">Correo Electrónico</label>
            <input 
                id="correo" 
                type="email" 
                name="correo" 
                value="{{ old('correo') }}" 
                required 
                placeholder="Ingresa tu correo electrónico"
            >

        </div>

        
        <!-- Correo Electrónico -->
        <div>
            <label for="direccion">Dirección</label>
            <input 
                id="direccion" 
                type="text" 
                name="direccion" 
                value="{{ old('direccion') }}" 
                required 
                placeholder="Ingresa tu dirección"
            >

        </div>

        <div>
            <label for="telefono">Teléfono</label>
            <input 
                id="telefono" 
                type="number" 
                name="telefono" 
                value="{{ old('telefono') }}" 
                required 
                placeholder="Ingresa tu teléfono"
            >

        </div>

        <!-- Contraseña -->
        <div>
            <label for="password">Contraseña</label>
            <input 
                id="contrasena" 
                type="password" 
                name="contrasena" 
                required 
                placeholder="Ingresa tu contraseña"
            >
     
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="contrasena_confirmation">Confirmar Contraseña</label>
            <input 
                id="contrasena_confirmation" 
                type="password" 
                name="contrasena_confirmation" 
                required 
                placeholder="Confirma tu contraseña"
            >
        </div>

        <!-- Selección de Rol -->
        <div>
            <label for="id_rol">Rol</label>
            <select id="id_rol" name="id_rol" required>
                <option value="" disabled selected>Selecciona un rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                @endforeach
            </select>

        </div>

        <!-- Botón de envío -->
        <div>
            <button type="submit" id="submitButton">Registrarse</button>
        </div>
    </form>

</div>

<!-- Scripts de mensajes -->
@if(session('success'))
    <script>
        mensajeDeExito("{{ session('success') }}");
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

</body>
</html>
