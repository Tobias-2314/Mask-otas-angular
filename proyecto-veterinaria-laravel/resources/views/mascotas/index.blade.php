@extends('layouts.app')

@section('titulo', 'Mis Mascotas')

@section('contenido')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Mis Mascotas</h1>
        <a href="{{ route('mascotas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            + Añadir Mascota
        </a>
    </div>

    @if(session('exito'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('exito') }}</p>
        </div>
    @endif

    @if($mascotas->isEmpty())
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <p class="text-gray-500 text-lg">No tienes mascotas registradas aún.</p>
            <a href="{{ route('mascotas.create') }}" class="mt-4 inline-block text-indigo-600 hover:underline">¡Registra a tu primera mascota!</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($mascotas as $mascota)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $mascota->nombre }}</h2>
                                <p class="text-sm text-gray-500">{{ $mascota->tipo }} @if($mascota->raza) - {{ $mascota->raza }} @endif</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $mascota->genero ?? 'N/A' }}
                            </span>
                        </div>
                        
                        <div class="mt-4 space-y-2">
                            @if($mascota->edad)
                                <p class="text-gray-600"><span class="font-semibold">Edad:</span> {{ $mascota->edad }} años</p>
                            @endif
                            @if($mascota->peso)
                                <p class="text-gray-600"><span class="font-semibold">Peso:</span> {{ $mascota->peso }} kg</p>
                            @endif
                            @if($mascota->notas_medicas)
                                <div class="mt-3 p-3 bg-gray-50 rounded-md text-sm text-gray-600">
                                    <span class="font-semibold block mb-1">Notas Médicas:</span>
                                    {{ Str::limit($mascota->notas_medicas, 100) }}
                                </div>
                            @endif
                        </div>

                        <div class="mt-6 flex justify-end">
                            <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar a {{ $mascota->nombre }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
