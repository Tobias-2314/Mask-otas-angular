@extends('layouts.app')

@section('titulo', 'Atención Médica')

@section('contenido')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Atención de Cita #{{ $cita->id }}</h1>
        <a href="{{ route('veterinario.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">&larr; Volver al Panel</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Columna Izquierda: Información del Paciente -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Paciente</h3>
                @if($cita->mascota)
                    <p class="mb-1"><span class="font-bold text-gray-600">Nombre:</span> {{ $cita->mascota->nombre }}</p>
                    <p class="mb-1"><span class="font-bold text-gray-600">Especie:</span> {{ $cita->mascota->tipo }}</p>
                    <p class="mb-1"><span class="font-bold text-gray-600">Raza:</span> {{ $cita->mascota->raza ?? 'N/A' }}</p>
                    <p class="mb-1"><span class="font-bold text-gray-600">Edad:</span> {{ $cita->mascota->edad }} años</p>
                    <p class="mb-1"><span class="font-bold text-gray-600">Peso:</span> {{ $cita->mascota->peso }} kg</p>
                    @if($cita->mascota->notas_medicas)
                        <div class="mt-3 p-2 bg-red-50 text-red-700 text-sm rounded border border-red-100">
                            <strong>Alerta Médica:</strong> {{ $cita->mascota->notas_medicas }}
                        </div>
                    @endif
                @else
                    <p><span class="font-bold">Nombre:</span> {{ $cita->nombre_mascota }}</p>
                    <p><span class="font-bold">Tipo:</span> {{ $cita->tipo_mascota }}</p>
                    <p class="text-sm text-gray-500 italic mt-2">Mascota no registrada en sistema.</p>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Dueño</h3>
                <p class="mb-1"><span class="font-bold text-gray-600">Nombre:</span> {{ $cita->nombre_dueno }}</p>
                <p class="mb-1"><span class="font-bold text-gray-600">Teléfono:</span> {{ $cita->telefono }}</p>
                <p class="mb-1"><span class="font-bold text-gray-600">Email:</span> {{ $cita->email }}</p>
            </div>
        </div>

        <!-- Columna Derecha: Formulario Clínico -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-indigo-500">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Registro Clínico</h2>
                
                @if(session('exito'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('exito') }}</div>
                @endif

                <form action="{{ route('veterinario.update', $cita->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label for="diagnostico" class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico</label>
                        <textarea name="diagnostico" id="diagnostico" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('diagnostico', $cita->diagnostico) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="tratamiento" class="block text-sm font-semibold text-gray-700 mb-2">Tratamiento / Receta</label>
                        <textarea name="tratamiento" id="tratamiento" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('tratamiento', $cita->tratamiento) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Este campo será visible para el dueño.</p>
                    </div>

                    <div class="mb-6">
                        <label for="notas_internas" class="block text-sm font-semibold text-gray-700 mb-2">Notas Internas (Oculto al cliente)</label>
                        <textarea name="notas_internas" id="notas_internas" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-yellow-50">{{ old('notas_internas', $cita->notas_internas) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado de Cita</label>
                            <select name="estado" id="estado" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmado" {{ $cita->estado == 'confirmado' ? 'selected' : '' }}>En Progreso / Confirmado</option>
                                <option value="completado" {{ $cita->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200">
                            Guardar Historia Clínica
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
