<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // IMPORTANTE: Esto es necesario para extender Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller // Extiende de Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Maneja el inicio de sesión
    public function login(Request $request)
    {
        // Valida los datos del formulario de inicio de sesión
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cierra la sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
