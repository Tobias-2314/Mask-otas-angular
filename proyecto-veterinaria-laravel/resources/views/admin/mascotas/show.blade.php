@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Header con Botón de Volver -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Perfil de {{ $mascota->nombre }}</h1>
            <a href="{{ route('admin.mascotas') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1 font-semibold">
                &larr; Volver a la lista
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna Izquierda: Detalles Mascota y Dueño -->
            <div class="md:col-span-1 space-y-6">
                <!-- Tarjeta Mascota -->
                <div class="bg-white rounded-lg shadow p-6 border-t-4 border-pink-500">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Datos de la Mascota</h3>
                    <div class="space-y-3">
                        <p class="text-gray-600"><span class="font-semibold text-gray-800">Tipo:</span> {{ $mascota->tipo }}</p>
                        <p class="text-gray-600"><span class="font-semibold text-gray-800">Raza:</span> {{ $mascota->raza ?? 'No especificada' }}</p>
                        <p class="text-gray-600"><span class="font-semibold text-gray-800">Edad:</span> {{ $mascota->edad ?? '-' }} años</p>
                        <p class="text-gray-600"><span class="font-semibold text-gray-800">Peso:</span> {{ $mascota->peso ?? '-' }} kg</p>
                        <p class="text-gray-600"><span class="font-semibold text-gray-800">Género:</span> {{ $mascota->genero ?? 'N/A' }}</p>
                        
                        @if($mascota->notas_medicas)
                        <div class="mt-4 p-3 bg-red-50 text-red-800 text-sm rounded border border-red-100">
                            <strong>⚠️ Notas Médicas / Alergias:</strong><br>
                            {{ $mascota->notas_medicas }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                        <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta mascota? Se borrará todo su historial.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold hover:underline">Eliminar Mascota</button>
                        </form>
                    </div>
                </div>

                <!-- Tarjeta Dueño -->
                <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Datos del Dueño</h3>
                    <div class="space-y-2">
                        <p class="text-gray-800 font-medium text-lg">{{ $mascota->dueno->nombre }}</p>
                        <p class="text-gray-600 text-sm">{{ $mascota->dueno->email }}</p>
                        <p class="text-gray-500 text-xs mt-2">Registrado el: {{ $mascota->dueno->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Historial Médico -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Formulario Nuevo Evento -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 p-1.5 rounded-full text-xs"><i class="fas fa-plus"></i></span>
                        Agregar Evento al Historial
                    </h3>
                    
                    @if(session('exito'))
                        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">{{ session('exito') }}</div>
                    @endif

                    <form action="{{ route('admin.mascotas.historial', $mascota->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipo de Evento</label>
                                <select name="tipo" class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                                    <option value="Consulta">Consulta General</option>
                                    <option value="Vacunación">Vacunación</option>
                                    <option value="Cirugía">Cirugía</option>
                                    <option value="Desparasitación">Desparasitación</option>
                                    <option value="Estética">Estética / Baño</option>
                                    <option value="Nota">Nota Interna</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fecha</label>
                                <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Descripción / Detalles</label>
                            <textarea name="descripcion" rows="2" class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Detalles del procedimiento, medicamentos recetados, observaciones..." required></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow-sm text-sm transition">
                                Guardar Evento
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Línea de Tiempo del Historial -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700">Historial Clínico</h3>
                        <span class="text-xs text-gray-500">{{ $mascota->historial->count() }} eventos registrados</span>
                    </div>
                    
                    @if($mascota->historial->isEmpty())
                        <div class="p-8 text-center text-gray-500 italic">
                            No hay historial registrado para esta mascota aún.
                        </div>
                    @else
                        <div class="divide-y divide-gray-100">
                            @foreach($mascota->historial->sortByDesc('fecha') as $evento)
                                <div class="p-6 hover:bg-gray-50 transition duration-150">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center gap-3">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold 
                                                @if($evento->tipo == 'Vacunación') bg-blue-100 text-blue-800
                                                @elseif($evento->tipo == 'Cirugía') bg-red-100 text-red-800
                                                @elseif($evento->tipo == 'Estética') bg-pink-100 text-pink-800
                                                @else bg-gray-200 text-gray-800 @endif">
                                                {{ $evento->tipo }}
                                            </span>
                                            <span class="text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="text-xs text-gray-400" title="Registrado por">
                                            <i class="fas fa-user-edit mr-1"></i> {{ $evento->usuario->nombre ?? 'Sistema' }}
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">{{ $evento->descripcion }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
