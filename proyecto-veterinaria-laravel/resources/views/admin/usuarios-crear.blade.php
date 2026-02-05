@extends('layouts.app')

@section('contenido')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Crear Nuevo Usuario</h2>
            
            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.usuarios.guardar') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required minlength="6">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Rol</label>
                    <select name="role" class="w-full border rounded px-3 py-2">
                        <option value="usuario">Usuario</option>
                        <option value="veterinario">Veterinario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.usuarios') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
