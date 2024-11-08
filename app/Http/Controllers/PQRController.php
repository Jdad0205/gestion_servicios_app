<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\PQR;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Producto;


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
        'descripcion' => 'required|string',
        'tipo' => 'required|in:Peticion,Queja,Reclamo'
    ]);

    // Verificar si el usuario está autenticado
    if (Auth::check()) {  // Usando la fachada Auth en lugar de auth()
        $user = Auth::user(); // Esto debería devolver el objeto del usuario autenticado
            
            // Verificar si el usuario tiene un cliente asociado
            
                    // Buscar el cliente que tenga el mismo `id_usuario` que el `id` del usuario autenticado
        $cliente = Cliente::where('id_usuario', $user->id)->first();


            if (!$cliente) {
                return redirect()->back()->with('error', 'No se encontró un cliente asociado con este usuario.');
            }
    
        
            // Crear el registro de PQR en la base de datos
            Pqr::create([
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo,
                'id_cliente' => $cliente->id,  // Asociar el ID del usuario autenticado
            ]);

        return redirect()->back()->with('success', 'Su PQR ha sido registrado con éxito.');
    } else {
        return redirect()->route('login')->with('error', 'Por favor, inicie sesión.');
    }
    } catch (\Exception $e) {

        // Redirigir a la lista con el mensaje de error
        return redirect()->route('pqr.index_cliente')->with('error', 'Error al crear la PQR: ' . $e->getMessage());
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

    public function indexCliente()
{
    $pqrs = PQR::paginate(9); // Puedes ajustar la cantidad por página
    return view('pqr.index_cliente', compact('pqrs'));
}

public function indexSoporte()
{
    $pqrs = Pqr::with('cliente')->get();
    $cantidadPorEstado = Pqr::select('estado', DB::raw('count(*) as total'))
    ->groupBy('estado')
    ->pluck('total', 'estado');
    return view('pqr.index_soporte', compact('pqrs'));
}

public function solucionar(Request $request, $id)
{
    // Validación del campo descripcion_solucion
    $request->validate([
        'descripcion_solucion' => 'required|string|max:255',
    ]);

    // Buscar el PQR por su ID
    $pqr = Pqr::findOrFail($id);

    // Asignar la solución y cambiar el estado a "Resuelta"
    $pqr->descripcion_solucion = $request->descripcion_solucion;
    $pqr->estado = 'Resuelta';  // Cambia el estado a "Resuelta"
    $pqr->save();

    // Redirigir de vuelta a la vista indexSoporte con un mensaje de éxito
    return redirect()->route('pqr.index_soporte ')->with('success', 'Solución enviada y estado cambiado a Resuelta.');
}

// app/Http/Controllers/PqrController.php
public function solicitarServicio($id)
{
    // Buscar el servicio por ID
    $servicio = Servicio::findOrFail($id);
    $user = Auth::user(); // Esto debería devolver el objeto del usuario autenticado
            
    // Verificar si el usuario tiene un cliente asociado
    
            // Buscar el cliente que tenga el mismo `id_usuario` que el `id` del usuario autenticado
$cliente = Cliente::where('id_usuario', $user->id)->first();

    // Crear una nueva PQR de tipo "Petición"
    Pqr::create([
        'id_cliente' => $cliente->id,   // Asegúrate de que el cliente esté autenticado
        'servicio_id' => $servicio->id,
        'tipo' => 'Petición',           // Especifica que es una solicitud de servicio
        'descripcion' => 'Solicitud de servicio: ' . $servicio->descripcion, // Información adicional opcional
    ]);

    // Redirigir de vuelta con un mensaje de éxito
    return redirect()->back()->with('success', '¡Solicitud de servicio enviada correctamente!');
}


public function solicitarProducto($id)
    {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);
        $user = Auth::user(); // Obtener el usuario autenticado
        
        // Verificar si el usuario tiene un cliente asociado
        $cliente = Cliente::where('id_usuario', $user->id)->first();
        
        // Verificar si se encontró el cliente
        if (!$cliente) {
            return redirect()->back()->with('error', 'No se encontró un cliente asociado a tu cuenta.');
        }

        // Crear una nueva PQR de tipo "Petición" para el producto
        Pqr::create([
            'id_cliente' => $cliente->id,  // Asociamos la PQR al cliente
            'producto_id' => $producto->id,  // Asociamos la PQR al producto
            'tipo' => 'Petición',           // Especificamos que es una solicitud de producto
            'descripcion' => 'Solicitud de producto: ' . $producto->descripcion,  // Descripción de la solicitud
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', '¡Solicitud de producto enviada correctamente!');
    }



}
