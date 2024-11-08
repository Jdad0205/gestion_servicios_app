<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Maneja el inicio de sesión
    public function login(Request $request)
    {
        try {
            // Valida los datos del formulario de inicio de sesión
            $request->validate([
                'correo' => 'required|email', // Cambiado a 'email' para validación
                'contrasena' => 'required|min:8',
            ]);

            // Intenta autenticar al usuario
            if (Auth::attempt(['correo' => $request->correo, 'password' => $request->contrasena])) {
                return redirect()->route('dashboard');
            }

            // Redirige si las credenciales no coinciden
            return redirect()->route('login')->with('error', 'Las credenciales no coinciden');
            dd(Auth::user()); // Muestra todos los atributos del usuario autenticado

        } catch (\Exception $e) {
            // Loguea el error para depuración
            Log::error('Error en el inicio de sesión: ' . $e->getMessage());

            // Redirige al login con un mensaje de error
            return redirect()->route('login')->with('error', 'Hubo un problema al intentar iniciar sesión. Por favor, inténtelo nuevamente.' . $e->getMessage());
        }
    }

    // Cierra la sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
