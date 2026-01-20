@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Gestión de Usuarios</h1>
                <p class="text-gray-600 mt-2">Total: {{ $usuarios->total() }} usuarios</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                ← Volver al Dashboard
            </a>
        </div>

        @if(session('exito'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('exito') }}
            </div>
        @endif

        <!-- Tabla de Usuarios -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $usuario->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $usuario->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($usuario->es_admin)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Usuario</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if(!$usuario->es_admin)
                                    <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $usuarios->links() }}
        </div>
    </div>
</div>
@endsection
