<?php
namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::with(['cliente', 'servicio'])->get();
        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        return view('contratos.create', compact('clientes', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_servicio' => 'required',
            'descripcion' => 'nullable',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        Contrato::create($request->all());
        return redirect()->route('contratos.index');
    }

    public function show($id)
    {
        $contrato = Contrato::with(['cliente', 'servicio', 'productos'])->findOrFail($id);
        return view('contratos.show', compact('contrato'));
    }
}
