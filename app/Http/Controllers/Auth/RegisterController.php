<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        try {
            // Validar la solicitud
            $request->validate([
                'nombre_usuario' => 'required|max:50',
                'correo' => 'required|email|unique:usuarios,correo',
                'contrasena' => 'required|min:8|confirmed',
                'id_rol' => 'required|exists:roles,id'
            ]);
    
            // Crear el usuario
            $user = User::create([
                'nombre_usuario' => $request->nombre_usuario,
                'correo' => $request->correo,
                'contrasena' => Hash::make($request->contrasena),
                'id_rol' => $request->id_rol,
            ]);
    
            // Si el rol es de cliente, crear el registro en la tabla `clientes`
            if ($request->id_rol == 2) { // Suponiendo que el rol 'cliente' tiene id = 3
                DB::table('clientes')->insert([
                    'id_usuario' => $user->id,
                    'nombre' => $request->nombre_usuario,
                    'correo' => $request->correo,
                    'direccion' =>$request->direccion,
                    'telefono' =>$request->telefono,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            // Redirigir al usuario al dashboard con mensaje de éxito
            return redirect()->route('login')->with('success', 'Usuario registrado y autenticado correctamente.');
        } catch (\Exception $e) {
            // Loguear el error para referencia interna
            Log::error('Error en el registro de usuario: ' . $e->getMessage());
    
            // Redirigir con el error
            return redirect()->route('register')->with('error', 'Hubo un problema al registrar al usuario. Por favor, inténtelo nuevamente.' . $e->getMessage());
        }
    }
    }
