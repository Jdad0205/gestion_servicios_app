<?php


namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    // Muestra la lista de servicios
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    // Muestra el formulario para crear un nuevo servicio
    public function create()
    {
        return view('servicios.create');
    }

    // Almacena un nuevo servicio en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);

        Servicio::create($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio creado exitosamente.');
    }

    // Muestra un servicio específico
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    // Muestra el formulario para editar un servicio
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    // Actualiza un servicio en la base de datos
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    // Elimina un servicio de la base de datos
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado exitosamente.');
    }

    public function indexCliente()
{
    $servicios = Servicio::paginate(9); // Puedes ajustar la cantidad por página
    return view('servicios.index_cliente', compact('servicios'));
}

}
