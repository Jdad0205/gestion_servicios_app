<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Role;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
{
        // Traemos los usuarios junto con el nombre de su rol
        $users = DB::table('usuarios')
        ->join('roles', 'usuarios.id_rol', '=', 'roles.id')
        ->select('usuarios.*', 'roles.nombre as rol_nombre')
        ->get(); // Esto debe traer todos los usuarios con sus roles




    return view('users.index', compact('users'));
}


    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        $roles = Role::all();  // Obtener todos los roles para mostrarlos en el formulario
        return view('users.create', compact('roles'));  // Pasa los roles a la vista
    }
    
    // Almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|max:50',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:8|confirmed',
            'id_rol' => 'required|exists:roles,id'
        ]);

        User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('users.index');
    }

    // Mostrar los detalles de un usuario
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();  // Obtener todos los roles para mostrarlos en el formulario
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_usuario' => 'required|max:50',
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'contrasena' => 'nullable|min:8|confirmed',
            'id_rol' => 'required|exists:roles,id'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'contrasena' => $request->contrasena ? Hash::make($request->contrasena) : $user->contrasena,
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('users.index');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
