<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
         // Obtener todos los roles desde la base de datos
         $roles = DB::table('roles')->get();

         // Pasar los roles a la vista
         return view('auth.register', compact('roles'));
    }

    // Maneja el registro de nuevos usuarios
    public function register(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:Usuarios',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Validar que role_id exista en la tabla 'roles'
        ]);

        // Crear el usuario
        $Usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'role_id' => $request->role_id, // Asignar el rol del usuario
        ]);

        // Autenticar al usuario recién registrado
        Auth::login($Usuario);

        // Redirigir al usuario al dashboard
        return redirect()->route('dashboard');
    }
}
