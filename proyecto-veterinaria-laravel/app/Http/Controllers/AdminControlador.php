<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Resena;
use Illuminate\Support\Facades\Hash;

class AdminControlador extends Controller
{
    // Dashboard principal
    public function dashboard(Request $request)
    {
        $totalUsuarios = Usuario::count();
        $totalCitas = Cita::count();
        $totalResenas = Resena::count();
        $citasPendientes = Cita::where('estado', 'pendiente')->count();

        // --- Gráfica de Ventas ---
        $range = $request->get('range', '30'); // Default 30 días
        $startDate = now()->subDays($range);
        
        $salesData = \App\Models\Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Rellenar días vacíos
        $chartLabels = [];
        $chartData = [];
        $currentDate = $startDate->copy();
        
        // Iterar desde el inicio hasta hoy
        while ($currentDate <= now()) {
            $formattedDate = $currentDate->format('Y-m-d');
            $displayDate = $currentDate->format('d M');
            
            $daySale = $salesData->firstWhere('date', $formattedDate);
            
            $chartLabels[] = $displayDate;
            $chartData[] = $daySale ? $daySale->total : 0;
            
            $currentDate->addDay();
        }

        return view('admin.dashboard', compact('totalUsuarios', 'totalCitas', 'totalResenas', 'citasPendientes', 'chartLabels', 'chartData', 'range'));
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

    public function crearUsuario()
    {
        return view('admin.usuarios-crear');
    }

    public function guardarUsuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:usuario,admin,veterinario',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'contrasena' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.usuarios')->with('exito', 'Usuario creado correctamente');
    }

    // ========== GESTIÓN DE CITAS ==========
    public function citas()
    {
        $citas = Cita::with('usuario')->orderBy('fecha_preferida', 'desc')->paginate(15);
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

    public function editarCita($id)
    {
        $cita = Cita::with(['usuario', 'mascota'])->findOrFail($id);
        return view('admin.citas-editar', compact('cita'));
    }

    public function actualizarCita(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        
        $request->validate([
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'notas_internas' => 'nullable|string',
        ]);

        $cita->diagnostico = $request->diagnostico;
        $cita->tratamiento = $request->tratamiento;
        $cita->notas_internas = $request->notas_internas;
        
        // Asignar veterinario actual como el responsable (admin o vet logueado)
        $cita->veterinario_id = auth()->id();
        
        // Si se añade diagnóstico, marcar como completada si estaba confirmada
        if ($request->filled('diagnostico') && $cita->estado === 'confirmada') {
            // Opcional: cambiar estado, por ahora lo dejamos a elección manual o lógica futura
            // $cita->estado = 'completada'; // Si existiera ese estado
        }

        $cita->save();

        return redirect()->route('admin.citas')->with('exito', 'Información clínica actualizada correctamente.');
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

    // ========== GESTIÓN DE PRODUCTOS ==========
    public function productos()
    {
        $productos = \App\Models\Product::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.productos', compact('productos'));
    }

    public function crearProducto()
    {
        return view('admin.productos-form');
    }

    public function guardarProducto(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        \App\Models\Product::create($request->all());
        return redirect()->route('admin.productos')->with('exito', 'Producto creado correctamente');
    }

    public function editarProducto($id)
    {
        $producto = \App\Models\Product::findOrFail($id);
        return view('admin.productos-form', compact('producto'));
    }

    public function actualizarProducto(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        $producto = \App\Models\Product::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('admin.productos')->with('exito', 'Producto actualizado correctamente');
    }

    public function eliminarProducto($id)
    {
        $producto = \App\Models\Product::findOrFail($id);
        $producto->delete();
        return redirect()->route('admin.productos')->with('exito', 'Producto eliminado correctamente');
    }

    // ========== GESTIÓN DE MASCOTAS (HISTORIAL) ==========
    public function mascotas(Request $request)
    {
        $query = \App\Models\Mascota::with('dueno');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhereHas('dueno', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        }

        $mascotas = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.mascotas.index', compact('mascotas'));
    }

    public function verMascota($id)
    {
        $mascota = \App\Models\Mascota::with(['dueno', 'historial.usuario'])->findOrFail($id);
        return view('admin.mascotas.show', compact('mascota'));
    }

    public function guardarHistorial(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        \App\Models\HistorialMedico::create([
            'mascota_id' => $id,
            'usuario_id' => auth()->id(),
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        return back()->with('exito', 'Evento médico agregado al historial.');
    }
}
