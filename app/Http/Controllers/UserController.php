<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Constructor con middleware de autenticación y autorización
    public function __construct()
    {
        // Asegúrate de que el usuario esté autenticado y tenga permisos de administrador
        $this->middleware('auth');
        $this->middleware('can:manage-users'); // O usa un middleware para roles específicos
    }

    // Muestra una lista de todos los usuarios
    public function index()
    {
        $users = User::paginate(10); // Paginación para mostrar 10 usuarios por página
        return view('users.index', compact('users'));
    }

    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        // Obtenemos todos los roles disponibles para asignar al usuario
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Almacena un nuevo usuario
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Asegúrate de que se confirme la contraseña
            'role_id' => 'required|exists:roles,id', // Asegúrate de que el role_id exista en la tabla roles
        ]);

        // Crear un nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Muestra el formulario para editar un usuario
    public function edit(User $user)
    {
        // Obtener todos los roles
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualiza los datos de un usuario
    public function update(Request $request, User $user)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Excluimos el correo actual
            'password' => 'nullable|string|min:8|confirmed', // El campo de password es opcional en la actualización
            'role_id' => 'required|exists:roles,id', // Verifica que el role_id exista
        ]);

        // Actualizamos los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Solo actualizamos la contraseña si se proporcionó
            'role_id' => $request->role_id,
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Elimina un usuario
    public function destroy(User $user)
    {
        // Verificar que no sea el usuario autenticado
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // Eliminar el usuario
        $user->delete();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
