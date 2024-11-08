<?phpnamespace App\Http\Controllers;
// app/Http/Controllers/RoleController.php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Mostrar todos los roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    }

    // Almacenar un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:roles,nombre|max:50'
        ]);

        Role::create($request->only('nombre'));

        return redirect()->route('roles.index');
    }

    // Mostrar el formulario para editar un rol
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    // Actualizar un rol
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:roles,nombre,' . $id . '|max:50'
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('nombre'));

        return redirect()->route('roles.index');
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index');
    }
}
