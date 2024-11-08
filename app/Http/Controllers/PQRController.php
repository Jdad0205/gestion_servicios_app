<?php

namespace App\Http\Controllers;

use App\Models\PQR;
use App\Models\Cliente;

use Illuminate\Http\Request;

class PQRController extends Controller
{
    // Mostrar todas las PQRs
    public function index()
    {
        $pqrs = PQR::all();
        return view('pqr.index', compact('pqrs'));
    }

    // Mostrar el formulario para crear una nueva PQR
    public function create()
    {
        // Obtener todos los clientes de la base de datos
        $clientes = Cliente::all();  // Asegúrate de tener el modelo Cliente importado
    
        // Pasar la lista de clientes a la vista
        return view('pqr.create', compact('clientes'));
    }
    
    public function store(Request $request)
{
    try {
    // Validar los datos del formulario
    $request->validate([
        'id_cliente' => 'required|integer',
        'tipo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'estado' => 'required|string|max:50',
    ]);


        // Intentar crear la PQR
        PQR::create([
            'id_cliente' => $request->id_cliente,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fecha_creacion' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirigir a la página de índice con mensaje de éxito
        return redirect()->route('pqr.index')->with('success', 'PQR creada exitosamente.');

    } catch (\Exception $e) {

        // Redirigir a la lista con el mensaje de error
        return redirect()->route('pqr.index')->with('error', 'Error al crear la PQR: ' . $e->getMessage());
        // Capturar cualquier excepción y redirigir con mensaje de error
    }
}

    // Mostrar los detalles de una PQR específica
    public function show($id)
    {
        $pqr = PQR::findOrFail($id);
        return view('pqr.show', compact('pqr'));
    }

    // Mostrar el formulario para editar una PQR
    public function edit($id)
    {
        $pqr = PQR::findOrFail($id);
         // Obtener todos los clientes de la base de datos
         $clientes = Cliente::all();  // Asegúrate de tener el modelo Cliente importado
            
        return view('pqr.edit', compact('pqr', 'clientes'));
    }

    // Actualizar una PQR
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required|integer',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|string|max:50',
            'fecha_creacion' => 'required|date',
        ]);

        $pqr = PQR::findOrFail($id);
        $pqr->update([
            'id_cliente' => $request->id_cliente,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fecha_creacion' => $request->fecha_creacion,
            'updated_at' => now(),
        ]);

        return redirect()->route('pqr.index')->with('success', 'PQR actualizada exitosamente.');
    }

    // Eliminar una PQR
    public function destroy($id)
    {
        $pqr = PQR::findOrFail($id);
        $pqr->delete();

        return redirect()->route('pqr.index')->with('success', 'PQR eliminada exitosamente.');
    }
}
