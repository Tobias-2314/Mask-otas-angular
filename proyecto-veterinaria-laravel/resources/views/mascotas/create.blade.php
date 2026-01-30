@extends('layouts.app')

@section('titulo', 'Registrar Mascota')

@section('contenido')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrar Nueva Mascota</h2>

    <form action="{{ route('mascotas.store') }}" method="POST">
        @csrf
        @if(isset($usuarios) && count($usuarios) > 0)
            <div class="mb-4 p-4 bg-purple-50 rounded-lg border border-purple-200">
                <label for="usuario_id" class="block text-sm font-bold text-purple-800 mb-1">
                    <i class="fas fa-user-tag text-purple-600 mr-1"></i> Asignar Dueño (Admin)
                </label>
                <select name="usuario_id" id="usuario_id" class="w-full rounded-md border-purple-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option value="">-- Seleccionar Usuario --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }} ({{ $usuario->email }}) - {{ ucfirst($usuario->role) }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-purple-600 mt-1">Si no seleccionas ninguno, se registrará a tu nombre.</p>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <!-- Tipo -->
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Animal</label>
                <select name="tipo" id="tipo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Conejo">Conejo</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <!-- Raza -->
            <div>
                <label for="raza" class="block text-sm font-medium text-gray-700 mb-1">Raza (Opcional)</label>
                <input type="text" name="raza" id="raza" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- Género -->
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                <select name="genero" id="genero" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                    <option value="Desconocido">Desconocido</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <!-- Edad -->
            <div>
                <label for="edad" class="block text-sm font-medium text-gray-700 mb-1">Edad (Años)</label>
                <input type="number" name="edad" id="edad" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- Peso -->
            <div>
                <label for="peso" class="block text-sm font-medium text-gray-700 mb-1">Peso (Kg)</label>
                <input type="number" name="peso" id="peso" step="0.1" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>

        <!-- Notas Médicas -->
        <div class="mb-6">
            <label for="notas_medicas" class="block text-sm font-medium text-gray-700 mb-1">Notas Médicas / Alergias</label>
            <textarea name="notas_medicas" id="notas_medicas" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Información relevante sobre la salud de la mascota..."></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('mascotas.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Registrar Mascota
            </button>
        </div>
    </form>
</div>
@endsection
