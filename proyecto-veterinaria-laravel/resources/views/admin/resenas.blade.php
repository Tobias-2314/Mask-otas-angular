@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Gestión de Reseñas</h1>
                <p class="text-gray-600 mt-2">Total: {{ $resenas->total() }} reseñas</p>
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

        <!-- Grid de Reseñas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($resenas as $resena)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <!-- Header de la reseña -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 rounded-full w-12 h-12 flex items-center justify-center">
                                <span class="text-indigo-600 font-bold text-lg">{{ substr($resena->usuario->nombre ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">{{ $resena->usuario->nombre ?? 'Usuario' }}</p>
                                <p class="text-xs text-gray-500">{{ $resena->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <!-- Calificación -->
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $resena->calificacion)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <!-- Comentario -->
                    <p class="text-gray-700 mb-4">{{ $resena->comentario }}</p>

                    <!-- Acciones -->
                    <div class="border-t pt-4">
                        <form action="{{ route('admin.resenas.eliminar', $resena->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta reseña?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                                Eliminar Reseña
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No hay reseñas registradas</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $resenas->links() }}
        </div>
    </div>
</div>
@endsection
