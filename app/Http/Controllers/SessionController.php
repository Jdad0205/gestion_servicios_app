<?php// app/Http/Controllers/SessionController.php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    // Mostrar todas las sesiones
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    // Crear una nueva sesión
    public function create()
    {
        return view('sessions.create');
    }

    // Almacenar una nueva sesión
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'ip_address' => 'required|string|max:45',
            'user_agent' => 'required|string',
            'payload' => 'required',
            'last_activity' => 'required|integer'
        ]);

        Session::create($request->all());

        return redirect()->route('sessions.index');
    }

    // Mostrar los detalles de una sesión
    public function show($id)
    {
        $session = Session::findOrFail($id);
        return view('sessions.show', compact('session'));
    }

    // Eliminar una sesión
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();

        return redirect()->route('sessions.index');
    }
}
