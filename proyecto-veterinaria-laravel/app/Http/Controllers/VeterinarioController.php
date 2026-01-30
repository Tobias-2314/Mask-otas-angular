<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VeterinarioController extends Controller
{
    // Dashboard: Ver próximas citas
    public function index()
    {
        // Mostrar citas pendientes o confirmadas, ordenadas por fecha
        $citas = Cita::whereIn('estado', ['pendiente', 'confirmado'])
                     ->orderBy('fecha_preferida', 'asc')
                     ->get();

        return view('veterinario.dashboard', compact('citas'));
    }

    // Ver detalle de cita y formulario médico
    public function show($id)
    {
        $cita = Cita::with(['usuario', 'mascota'])->findOrFail($id);
        return view('veterinario.show', compact('cita'));
    }

    // Actualizar diagnóstico y tratamiento
    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $datos = $request->validate([
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'notas_internas' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        // Asignar veterinario si no tiene
        if (!$cita->veterinario_id) {
            $cita->veterinario_id = Auth::id();
        }

        $cita->update($datos);

        return back()->with('exito', 'Historial clínico actualizado.');
    }
}
