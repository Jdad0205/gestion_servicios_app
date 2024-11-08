<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Contrato;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Mostrar todas las facturas
    public function index()
    {
        $facturas = Factura::all();  // Obtener todas las facturas
        return view('facturas.index', compact('facturas'));  // Vista para listar las facturas
    }

    // Mostrar el formulario para crear una nueva factura
    public function create()
    {
        // Obtener clientes y contratos para el formulario
        $clientes = Cliente::all();
        $contratos = Contrato::all();
        
        return view('facturas.create', compact('clientes', 'contratos'));  // Vista para crear factura
    }

    // Almacenar una nueva factura
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'id_contrato' => 'required|exists:contratos,id',  // Verificar que el contrato exista
            'id_cliente' => 'required|exists:clientes,id',  // Verificar que el cliente exista
            'precio' => 'required|numeric',
            'impuestos' => 'required|numeric',
            'total_pagar' => 'required|numeric',
            'fecha_emision' => 'required|date',
        ]);

        // Crear una nueva factura
        Factura::create([
            'id_contrato' => $request->id_contrato,
            'id_cliente' => $request->id_cliente,
            'precio' => $request->precio,
            'impuestos' => $request->impuestos,
            'total_pagar' => $request->total_pagar,
            'fecha_emision' => $request->fecha_emision,
        ]);

        // Redirigir a la lista de facturas
        return redirect()->route('facturas.index');
    }

    // Mostrar los detalles de una factura específica
    public function show($id)
    {
        $factura = Factura::findOrFail($id);  // Encontrar factura por id
        return view('facturas.show', compact('factura'));  // Vista para mostrar los detalles de la factura
    }

    // Mostrar el formulario para editar una factura
    public function edit($id)
    {
        $factura = Factura::findOrFail($id);  // Obtener factura a editar
        $clientes = Cliente::all();
        $contratos = Contrato::all();
        
        return view('facturas.edit', compact('factura', 'clientes', 'contratos'));  // Vista para editar factura
    }

    // Actualizar una factura
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos
        $request->validate([
            'id_contrato' => 'required|exists:contratos,id',
            'id_cliente' => 'required|exists:clientes,id',
            'precio' => 'required|numeric',
            'impuestos' => 'required|numeric',
            'total_pagar' => 'required|numeric',
            'fecha_emision' => 'required|date',
        ]);

        // Encontrar factura y actualizar
        $factura = Factura::findOrFail($id);
        $factura->update([
            'id_contrato' => $request->id_contrato,
            'id_cliente' => $request->id_cliente,
            'precio' => $request->precio,
            'impuestos' => $request->impuestos,
            'total_pagar' => $request->total_pagar,
            'fecha_emision' => $request->fecha_emision,
        ]);

        // Redirigir a la lista de facturas
        return redirect()->route('facturas.index');
    }

    // Eliminar una factura
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();  // Eliminar factura

        // Redirigir a la lista de facturas
        return redirect()->route('facturas.index');
    }
}
