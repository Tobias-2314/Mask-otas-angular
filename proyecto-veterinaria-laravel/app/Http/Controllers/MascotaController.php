<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mascota;
use App\Models\Usuario;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Auth::user()->mascotas;
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        $usuarios = [];
        if (Auth::user()->role === 'admin' || Auth::user()->es_admin) {
            $usuarios = Usuario::all();
        }
        return view('mascotas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'raza' => 'nullable',
            'edad' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'genero' => 'nullable',
            'notas_medicas' => 'nullable',
            'notas_medicas' => 'nullable',
            'usuario_id' => 'nullable|exists:usuarios,id', // Validación condicional
        ]);

        // Si es admin y eligió un usuario, usar ese ID. Si no, usar el propio.
        if ((Auth::user()->role === 'admin' || Auth::user()->es_admin) && !empty($request->usuario_id)) {
            $datos['usuario_id'] = $request->usuario_id;
        } else {
            $datos['usuario_id'] = Auth::id();
        }

        Mascota::create($datos);

        return redirect()->route('mascotas.index')->with('exito', 'Mascota registrada correctamente.');
    }

    public function destroy($id)
    {
        $mascota = Mascota::where('usuario_id', Auth::id())->findOrFail($id);
        $mascota->delete();
        return back()->with('exito', 'Mascota eliminada.');
    }
}
