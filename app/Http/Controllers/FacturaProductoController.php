<?php
namespace App\Http\Controllers;

use App\Models\FacturaProducto;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;

class FacturaProductoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_factura' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        FacturaProducto::create($request->all());
        return redirect()->route('facturas.show', ['id' => $request->id_factura]);
    }
}
