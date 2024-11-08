<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Servicio;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Mostrar todas las facturas
    public function index()
    {
        try {
            $facturas = Factura::all();  // Obtener todas las facturas
            return view('facturas.index', compact('facturas'));  // Vista para listar las facturas
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.index')
                             ->with('error', 'Hubo un error al cargar las facturas: ' . $e->getMessage());
        }
    }

    // Mostrar el formulario para crear una nueva factura
    public function create()
    {
        try {
            // Obtener clientes y contratos para el formulario
            $clientes = Cliente::all();
            $contratos = Contrato::all();
            $servicios = Servicio::all();
        
            return view('facturas.create', compact('clientes', 'contratos', 'servicios'));  // Vista para crear factura
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.index')
                             ->with('error', 'Hubo un error al cargar los datos para crear la factura: ' . $e->getMessage());
        }
    }

    // Almacenar una nueva factura
    public function store(Request $request)
    {
        try {
            // Validación de los datos recibidos
            $request->validate([
                'id_contrato' => 'required|exists:contratos,id',
                'id_cliente' => 'required|exists:clientes,id',
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
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.create')
                             ->with('error', 'Hubo un error al crear la factura: ' . $e->getMessage());
        }
    }

    // Mostrar los detalles de una factura específica
    public function show($id)
    {
        try {
            $factura = Factura::findOrFail($id);  // Encontrar factura por id
            return view('facturas.show', compact('factura'));  // Vista para mostrar los detalles de la factura
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.index')
                             ->with('error', 'Hubo un error al cargar los detalles de la factura: ' . $e->getMessage());
        }
    }

    // Mostrar el formulario para editar una factura
    public function edit($id)
    {
        try {
            $factura = Factura::findOrFail($id);  // Obtener factura a editar
            $clientes = Cliente::all();
            $contratos = Contrato::all();
        
            return view('facturas.edit', compact('factura', 'clientes', 'contratos'));  // Vista para editar factura
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.index')
                             ->with('error', 'Hubo un error al cargar los datos para editar la factura: ' . $e->getMessage());
        }
    }

    // Actualizar una factura
    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.edit', ['id' => $id])
                             ->with('error', 'Hubo un error al actualizar la factura: ' . $e->getMessage());
        }
    }

    // Eliminar una factura
    public function destroy($id)
    {
        try {
            $factura = Factura::findOrFail($id);
            $factura->delete();  // Eliminar factura
    
            // Redirigir a la lista de facturas
            return redirect()->route('facturas.index');
        } catch (\Exception $e) {
            // En caso de error, redirigir con mensaje de error
            return redirect()->route('facturas.index')
                             ->with('error', 'Hubo un error al eliminar la factura: ' . $e->getMessage());
        }
    }
}
