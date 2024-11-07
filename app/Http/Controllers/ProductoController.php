<?php 

namespace App\Http\Controllers;

use App\Models\Producto; // Modelo Producto
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Constructor con middleware para proteger las rutas
    public function __construct()
    {
        $this->middleware('auth'); // Asegúrate de que el usuario esté autenticado
    }

    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('productos.index', compact('productos')); // Vista con los productos
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        return view('productos.create'); // Vista para crear un producto
    }

    // Almacenar un nuevo producto
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
            'precio' => 'required|numeric',
        ]);

        // Crear el producto
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id); // Buscar el producto por su id
        return view('productos.edit', compact('producto')); // Vista para editar el producto
    }

    // Actualizar el producto
    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
            'precio' => 'required|numeric',
        ]);

        // Buscar el producto por id y actualizarlo
        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        // Buscar y eliminar el producto por su id
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
