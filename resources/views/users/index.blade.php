@extends('layouts.app')

@section('content')
<h1>Lista de Usuarios</h1>
<a href="{{ route('usuarios.create') }}" class="btn btn-success boton-crear">Crear Usuario</a>

<table id="usuariosTable" class="table table-stripped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->nombre_usuario }}</td>
            <td>{{ $user->correo }}</td>
            <td>{{ $user->rol_nombre }}</td>
            <td>
                <!-- Usar $user->id en lugar del objeto completo -->
                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                
                <!-- Usar $user->id en lugar del objeto completo -->
                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
