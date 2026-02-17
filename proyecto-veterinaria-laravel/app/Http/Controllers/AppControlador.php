<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AppControlador extends Controller
{
    public function inicio()
    {
        // Obtener últimas 3 reseñas aprobadas para la home
        $resenas = Resena::where('aprobado', true)->latest()->take(3)->with('usuario')->get();
        return view('inicio', compact('resenas'));
    }

    public function ultimasResenas()
    {
        $resenas = Resena::where('aprobado', true)->latest()->take(3)->with('usuario')->get();
        return response()->json($resenas);
    }

    // Citas
    public function crearCita()
    {
        $mascotas = Auth::user()->mascotas;
        return view('citas.crear', compact('mascotas'));
    }

    public function obtenerCitasOcupadas()
    {
        // Obtener citas futuras (o de hoy en adelante) para bloquear en el calendario
        $citas = Cita::where('fecha_preferida', '>=', now()->toDateString())
                     ->whereIn('estado', ['pendiente', 'confirmada']) // Ignorar canceladas
                     ->get(['fecha_preferida', 'hora_preferida']);
        
        return response()->json($citas);
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
            'fecha_preferida' => 'required|date|after_or_equal:today',
            'hora_preferida' => 'required',
            'notas' => 'nullable',
        ]);

        // VERIFICAR DISPONIBILIDAD
        $existeCita = Cita::where('fecha_preferida', $datos['fecha_preferida'])
                          ->where('hora_preferida', $datos['hora_preferida'])
                          ->whereIn('estado', ['pendiente', 'confirmada'])
                          ->exists();

        if ($existeCita) {
            return back()->withInput()->withErrors(['hora_preferida' => 'Este horario ya está reservado. Por favor elige otro.']);
        }

        $datos['usuario_id'] = Auth::id();

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

        $resena = Resena::create($datos);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Reseña publicada con éxito.',
                'resena' => $resena->load('usuario')
            ]);
        }

        return back()->with('exito', 'Reseña publicada.');
    }

    public function miCuenta()
    {
        $usuario = Auth::user();
        // Cargar citas y mascotas
        $mascotas = $usuario->mascotas;
        $citas = $usuario->citas()->latest()->get();
        // Cargar pedidos
        $orders = Order::where('user_id', $usuario->id)->orderBy('created_at', 'desc')->get();

        return view('usuario.mi-cuenta', compact('usuario', 'mascotas', 'citas', 'orders'));
    }

    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $dados = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $usuario->nombre = $dados['nombre'];
        $usuario->email = $dados['email'];

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($usuario->foto_perfil && \Illuminate\Support\Facades\Storage::exists('public/' . $usuario->foto_perfil)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $usuario->foto_perfil);
            }

            $path = $request->file('foto')->store('perfiles', 'public');
            $usuario->foto_perfil = $path;
        }

        $usuario->save();

        return back()->with('exito', 'Perfil actualizado correctamente.');
    }
}
