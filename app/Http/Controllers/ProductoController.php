<?php 
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(9); 
        return view('productos.index', compact('productos'));
    } 

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function indexCliente()
    {
        $productos = Producto::all();
        return view('productos.index_cliente', compact('productos'));
    }
 
}
