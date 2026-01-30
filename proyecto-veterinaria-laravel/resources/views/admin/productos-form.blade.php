@extends('layouts.app')

@section('contenido')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900">{{ isset($producto) ? 'Editar Producto' : 'Nuevo Producto' }}
                </h1>
                <p class="text-gray-600 mt-2">
                    {{ isset($producto) ? 'Modifica los datos del producto' : 'Completa el formulario para añadir un producto' }}
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8">
                <form
                    action="{{ isset($producto) ? route('admin.productos.actualizar', $producto->id) : route('admin.productos.guardar') }}"
                    method="POST">
                    @csrf
                    @if(isset($producto))
                        @method('PATCH')
                    @endif

                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                            Nombre del Producto *
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $producto->name ?? '') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                            Descripción *
                        </label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 @error('description') border-red-500 @enderror">{{ old('description', $producto->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
                                Precio (€) *
                            </label>
                            <input type="number" step="0.01" name="price" id="price"
                                value="{{ old('price', $producto->price ?? '') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">
                                Stock *
                            </label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $producto->stock ?? '0') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 @error('stock') border-red-500 @enderror">
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                            URL de la Imagen
                        </label>
                        <input type="url" name="image" id="image" value="{{ old('image', $producto->image ?? '') }}"
                            placeholder="https://ejemplo.com/imagen.jpg"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Opcional. Debe ser una URL válida de imagen.</p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-lg"
                            style="background-color: #ea580c !important; color: white !important;">
                            <i class="fas fa-save mr-2"></i>
                            {{ isset($producto) ? 'Actualizar Producto' : 'Crear Producto' }}
                        </button>
                        <a href="{{ route('admin.productos') }}"
                            class="flex-1 inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-lg text-center"
                            style="background-color: #4b5563 !important; color: white !important;">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection