@extends('layouts.app')

@section('titulo', 'Panel Veterinario')

@section('contenido')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de Control Veterinario</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha/Hora</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mascota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dueño</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($citas as $cita)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $cita->fecha_preferida }} <br>
                            <span class="text-gray-500 text-xs">{{ $cita->hora_preferida }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($cita->mascota)
                                <div class="text-sm font-medium text-gray-900">{{ $cita->mascota->nombre }}</div>
                                <div class="text-sm text-gray-500">{{ $cita->mascota->tipo }}</div>
                            @elseif($cita->nombre_mascota)
                                <div class="text-sm font-medium text-gray-900">{{ $cita->nombre_mascota }}</div>
                                <div class="text-sm text-gray-500">{{ $cita->tipo_mascota }} (No reg.)</div>
                            @else
                                <span class="text-gray-400 italic">No especificado</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $cita->nombre_dueno }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $cita->tipo_servicio }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $cita->estado === 'confirmado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('veterinario.show', $cita->id) }}" class="text-indigo-600 hover:text-indigo-900">Atender</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($citas->isEmpty())
            <div class="p-6 text-center text-gray-500">
                No hay citas pendientes para hoy.
            </div>
        @endif
    </div>
</div>
@endsection
