@extends('layouts.app')

@section('contenido')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Gestión de Productos</h1>
                    <p class="text-gray-600 mt-2">Administra los productos de la tienda</p>
                </div>
                <a href="{{ route('admin.productos.crear') }}"
                    class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-lg"
                    style="background-color: #ea580c !important; color: white !important;">
                    <i class="fas fa-plus mr-2"></i> Nuevo Producto
                </a>
            </div>

            @if(session('exito'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('exito') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6">
                    @foreach($productos as $producto)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition">
                            <div class="h-48 overflow-hidden bg-gray-100">
                                @if($producto->image)
                                    <img src="{{ $producto->image }}" alt="{{ $producto->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-box text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $producto->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($producto->description, 80) }}
                                </p>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-xl font-bold text-orange-600">{{ number_format($producto->price, 2) }}
                                        €</span>
                                    <span class="text-sm text-gray-500">Stock: {{ $producto->stock }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.productos.editar', $producto->id) }}"
                                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 px-3 rounded text-sm font-bold transition">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.productos.eliminar', $producto->id) }}" method="POST"
                                        class="flex-1" onsubmit="return confirm('¿Eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded text-sm font-bold transition">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($productos->isEmpty())
                    <div class="text-center py-20">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-xl">No hay productos registrados</p>
                    </div>
                @endif

                <div class="p-6">
                    {{ $productos->links() }}
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 font-semibold hover:underline">
                    <i class="fas fa-arrow-left mr-2"></i> Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection