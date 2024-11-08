<?php
// app/Http/Controllers/ClienteController.php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Almacenar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'telefono' => 'nullable|max:15',
            'direccion' => 'nullable|max:255',
            'correo' => 'nullable|email|max:100|unique:clientes,correo',
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'correo' => $request->correo,
        ]);

        return redirect()->route('clientes.index');
    }

    // Mostrar los detalles de un cliente
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar el formulario para editar un cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'telefono' => 'nullable|max:15',
            'direccion' => 'nullable|max:255',
            'correo' => 'nullable|email|max:100|unique:clientes,correo,' . $id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'correo' => $request->correo,
        ]);

        return redirect()->route('clientes.index');
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }
}
