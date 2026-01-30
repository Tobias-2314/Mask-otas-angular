<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

class AppControlador extends Controller
{
    // Citas
    public function crearCita()
    {
        $mascotas = Auth::check() ? Auth::user()->mascotas : [];
        return view('citas.crear', compact('mascotas'));
    }

    public function guardarCita(Request $request)
    {
        // Validación básica
        $datos = $request->validate([
            'nombre_dueno' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'nombre_mascota' => 'nullable|required_without:mascota_id',
            'mascota_id' => 'nullable|exists:mascotas,id',
            'tipo_mascota' => 'nullable|required_without:mascota_id',
            'tipo_servicio' => 'required',
            'fecha_preferida' => 'required|date',
            'hora_preferida' => 'required',
            'notas' => 'nullable',
        ]);

        if (Auth::check()) {
            $datos['usuario_id'] = Auth::id();
        }

        // Si selecciona mascota, rellenar datos automáticos si faltan
        if (!empty($datos['mascota_id'])) {
            $mascota = \App\Models\Mascota::find($datos['mascota_id']);
            if ($mascota) {
                $datos['nombre_mascota'] = $mascota->nombre;
                $datos['tipo_mascota'] = $mascota->tipo;
            }
        }

        Cita::create($datos);
        return redirect('/')->with('exito', 'Cita agendada.');
    }

    // Reseñas
    public function verResenas()
    {
        $resenas = Resena::latest()->get(); // Sin filtro 'aprobado' para simplicidad
        return view('resenas.index', compact('resenas'));
    }

    public function guardarResena(Request $request)
    {
        $datos = $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required'
        ]);

        $datos['usuario_id'] = Auth::id();
        $datos['aprobado'] = true;

        Resena::create($datos);
        return back()->with('exito', 'Reseña publicada.');
    }
}
