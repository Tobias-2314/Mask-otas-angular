@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Lo que dicen nuestros clientes</h2>
            <p class="text-gray-600 mt-4">Nuestra mejor garantía es la satisfacción de nuestras mascotas y sus dueños.</p>
        </div>

        <!-- Lista de Reseñas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($resenas as $resena)
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            @for($i = 0; $i < $resena->calificacion; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"{{ $resena->comentario }}"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                            {{ substr($resena->usuario->nombre ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $resena->usuario->nombre ?? 'Anónimo' }}</p>
                            <p class="text-xs text-gray-500">{{ $resena->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Formulario Nueva Reseña -->
        @auth
            <div class="max-w-xl mx-auto bg-indigo-50 p-8 rounded-2xl border border-indigo-100">
                <h3 class="text-2xl font-bold text-indigo-900 mb-6 text-center">Deja tu reseña</h3>
                <form action="{{ route('resenas.guardar') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Calificación</label>
                        <div class="flex gap-4">
                            <label class="cursor-pointer"><input type="radio" name="calificacion" value="5" checked
                                    class="mr-1"> ⭐⭐⭐⭐⭐</label>
                            <label class="cursor-pointer"><input type="radio" name="calificacion" value="4" class="mr-1">
                                ⭐⭐⭐⭐</label>
                            <label class="cursor-pointer"><input type="radio" name="calificacion" value="3" class="mr-1">
                                ⭐⭐⭐</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Comentario</label>
                        <textarea name="comentario" rows="3"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required placeholder="Cuéntanos tu experiencia..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
                        Publicar Reseña
                    </button>
                </form>
            </div>
        @else
            <div class="text-center">
                <p class="text-gray-600">¿Quieres dejar una reseña? <a href="{{ route('login') }}"
                        class="text-indigo-600 font-bold hover:underline">Inicia sesión</a></p>
            </div>
        @endauth
    </div>
@endsection