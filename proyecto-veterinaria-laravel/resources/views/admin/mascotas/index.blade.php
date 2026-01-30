@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Mascotas</h1>
            <a href="{{ route('mascotas.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                + Nueva Mascota
            </a>
        </div>

        <!-- Buscador -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <form action="{{ route('admin.mascotas') }}" method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Buscar por nombre de mascota, dueño o email..." 
                       value="{{ request('search') }}"
                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-semibold transition">
                    Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.mascotas') }}" class="flex items-center text-gray-500 hover:text-gray-700">Limpiar</a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mascota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dueño</th>
                         <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mascotas as $mascota)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $mascota->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $mascota->tipo }} - {{ $mascota->raza ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($mascota->edad) {{ $mascota->edad }} años @endif
                                @if($mascota->peso) | {{ $mascota->peso }} kg @endif
                                <br>
                                <span class="text-xs">{{ $mascota->genero }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $mascota->dueno->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $mascota->dueno->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.mascotas.ver', $mascota->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-3 py-1 rounded-full">
                                    Ver Historial
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No se encontraron mascotas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $mascotas->links() }}
        </div>
    </div>
</div>
@endsection
