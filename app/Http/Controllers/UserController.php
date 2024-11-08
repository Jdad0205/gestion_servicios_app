<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        try {
            // Traemos los usuarios junto con el nombre de su rol
            $users = DB::table('usuarios')
                ->join('roles', 'usuarios.id_rol', '=', 'roles.id')
                ->select('usuarios.*', 'roles.nombre as rol_nombre')
                ->get(); // Esto debe traer todos los usuarios con sus roles

            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Hubo un error al cargar los usuarios: ' . $e->getMessage());
        }
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        try {
            $roles = Role::all();  // Obtener todos los roles para mostrarlos en el formulario
            return view('users.create', compact('roles'));  // Pasa los roles a la vista
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Hubo un error al cargar los roles para la creación de usuario: ' . $e->getMessage());
        }
    }

    // Almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->route('users.create')
                             ->with('error', 'Hubo un error al crear el usuario: ' . $e->getMessage());
        }
    }

    // Mostrar los detalles de un usuario
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Hubo un error al cargar los detalles del usuario: ' . $e->getMessage());
        }
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();  // Obtener todos los roles para mostrarlos en el formulario
            return view('users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Hubo un error al cargar el formulario de edición: ' . $e->getMessage());
        }
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->route('users.edit', ['id' => $id])
                             ->with('error', 'Hubo un error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Hubo un error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
