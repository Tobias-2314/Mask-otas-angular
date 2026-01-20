<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Resena;

class AdminControlador extends Controller
{
    // Dashboard principal
    public function dashboard()
    {
        $totalUsuarios = Usuario::count();
        $totalCitas = Cita::count();
        $totalResenas = Resena::count();
        $citasPendientes = Cita::where('estado', 'pendiente')->count();
        
        return view('admin.dashboard', compact('totalUsuarios', 'totalCitas', 'totalResenas', 'citasPendientes'));
    }

    // ========== GESTIÓN DE USUARIOS ==========
    public function usuarios()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('exito', 'Usuario eliminado correctamente');
    }

    // ========== GESTIÓN DE CITAS ==========
    public function citas()
    {
        $citas = Cita::with('usuario')->orderBy('fecha', 'desc')->paginate(15);
        return view('admin.citas', compact('citas'));
    }

    public function actualizarEstadoCita(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = $request->estado;
        $cita->save();
        
        return redirect()->route('admin.citas')->with('exito', 'Estado de la cita actualizado');
    }

    public function eliminarCita($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('admin.citas')->with('exito', 'Cita eliminada correctamente');
    }

    // ========== GESTIÓN DE RESEÑAS ==========
    public function resenas()
    {
        $resenas = Resena::with('usuario')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.resenas', compact('resenas'));
    }

    public function eliminarResena($id)
    {
        $resena = Resena::findOrFail($id);
        $resena->delete();
        return redirect()->route('admin.resenas')->with('exito', 'Reseña eliminada correctamente');
    }
}
