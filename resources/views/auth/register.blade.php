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
</head>
<body>
<div class="contenedor-registro">
    <h1>Registro</h1>
    
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Nombre del usuario -->
        <div>
            <label for="name">Nombre Completo</label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                placeholder="Ingresa tu nombre completo"
            >
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Correo Electrónico -->
        <div>
            <label for="email">Correo Electrónico</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                placeholder="Ingresa tu correo electrónico"
            >
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password">Contraseña</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                placeholder="Ingresa tu contraseña"
            >
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                placeholder="Confirma tu contraseña"
            >
        </div>

        <!-- Selección de Rol -->
        <div>
            <label for="role_id">Rol</label>
            <select id="role_id" name="role_id" required>
                <option value="" disabled selected>Selecciona un rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                @endforeach
            </select>
            @error('role_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botón de envío -->
        <div>
            <button type="submit" id="submitButton">Registrarse</button>
        </div>
    </form>

</div>
</body>
</html>
