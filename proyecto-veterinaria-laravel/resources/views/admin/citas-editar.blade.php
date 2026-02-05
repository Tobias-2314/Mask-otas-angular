@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.citas') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a Citas
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Encabezado de la Cita -->
            <div class="bg-indigo-600 text-white p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold">Gestión Clínica de Cita #{{ $cita->id }}</h1>
                        <p class="text-indigo-100 mt-1">
                            {{ \Carbon\Carbon::parse($cita->fecha_preferida)->isoFormat('dddd D [de] MMMM [de] YYYY') }} 
                            a las {{ $cita->hora_preferida }}
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                        {{ $cita->estado === 'pendiente' ? 'bg-yellow-400 text-yellow-900' : '' }}
                        {{ $cita->estado === 'confirmada' ? 'bg-green-400 text-green-900' : '' }}
                        {{ $cita->estado === 'cancelada' ? 'bg-red-400 text-red-900' : '' }}">
                        {{ $cita->estado }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-8">
                <!-- Info Paciente y Dueño (Sidebar) -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Mascota</h3>
                        @if($cita->mascota)
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xl">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $cita->mascota->nombre }}</p>
                                    <p class="text-sm text-gray-500">{{ $cita->mascota->tipo }} · {{ $cita->mascota->raza ?? 'Raza no esp.' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $cita->mascota->edad }} años</p>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 italic">Mascota no registrada (Info manual)</p>
                            <div class="mt-2 p-3 bg-white rounded border border-gray-200">
                                <p class="text-sm font-semibold">{{ $cita->nombre_mascota }}</p>
                                <p class="text-xs text-gray-500">{{ $cita->tipo_mascota }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Propietario</h3>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="overflow-hidden">
                                @if($cita->usuario)
                                    <p class="font-bold text-gray-900 truncate">{{ $cita->usuario->nombre }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $cita->usuario->email }}</p>
                                @else
                                    <p class="font-bold text-gray-900 truncate">{{ $cita->nombre_dueno }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $cita->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $cita->telefono }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                        <h3 class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-2">Motivo Cita</h3>
                        <p class="text-sm text-blue-900">{{ $cita->notas ?? 'Sin notas adicionales' }}</p>
                        <p class="text-xs text-blue-500 mt-2 font-semibold">Servicio: {{ $cita->tipo_servicio }}</p>
                    </div>
                </div>

                <!-- Formulario Clínico -->
                <div class="md:col-span-2">
                    <form action="{{ route('admin.citas.actualizar', $cita->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-stethoscope text-indigo-500"></i> Evaluación Clínica
                                </h3>
                                <p class="text-sm text-gray-500 mb-4">Complete la información médica de la consulta.</p>
                            </div>

                            <div>
                                <label for="diagnostico" class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico</label>
                                <textarea name="diagnostico" id="diagnostico" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3" placeholder="Describa el diagnóstico de la mascota...">{{ old('diagnostico', $cita->diagnostico) }}</textarea>
                            </div>

                            <div>
                                <label for="tratamiento" class="block text-sm font-medium text-gray-700 mb-1">Tratamiento / Receta</label>
                                <textarea name="tratamiento" id="tratamiento" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3" placeholder="Medicamentos, dosis, procedimientos...">{{ old('tratamiento', $cita->tratamiento) }}</textarea>
                            </div>

                            <div>
                                <label for="notas_internas" class="block text-sm font-medium text-gray-700 mb-1">Notas Internas (Privado)</label>
                                <textarea name="notas_internas" id="notas_internas" rows="2" class="w-full rounded-lg border-gray-200 bg-yellow-50 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 p-3 text-sm" placeholder="Observaciones solo para personal veterinario...">{{ old('notas_internas', $cita->notas_internas) }}</textarea>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between border border-gray-100">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-user-md"></i>
                                    <span>Veterinario: <strong>{{ auth()->user()->nombre }}</strong></span>
                                </div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold shadow transition transform hover:scale-105">
                                    Guardar Historial
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
