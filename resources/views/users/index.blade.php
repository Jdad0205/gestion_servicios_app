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
            <td>{{ $user->id_rol }}</td>
            <td>
                <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('usuarios.destroy', $user) }}" method="POST" style="display:inline;">
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