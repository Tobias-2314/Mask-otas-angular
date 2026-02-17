@extends('layouts.app')

@section('titulo', 'Mi Cuenta')

@section('contenido')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Columna Izquierda: Perfil y Edición -->
        <div class="space-y-6">
            <!-- Tarjeta de Perfil -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-emerald-600 h-24"></div>
                <div class="px-6 pb-6 relative">
                    <div class="flex flex-col items-center -mt-12">
                        <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-200 overflow-hidden shadow-md flex items-center justify-center text-3xl font-bold text-gray-400">
                            @if($usuario->foto_perfil)
                                <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto Perfil" class="w-full h-full object-cover">
                            @else
                                {{ substr($usuario->nombre, 0, 1) }}
                            @endif
                        </div>
                        <h2 class="mt-3 text-xl font-bold text-gray-900">{{ $usuario->nombre }}</h2>
                        <p class="text-sm text-gray-500">{{ $usuario->email }}</p>
                        <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $usuario->role === 'veterinario' ? 'bg-blue-100 text-blue-800' : ($usuario->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($usuario->role) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Edición -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Editar Información</h3>
                
                <form action="{{ route('mi-cuenta.actualizar') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto de Perfil</label>
                        <div class="mt-1 flex items-center gap-4">
                            <label for="foto" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-lg shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                Subir nueva foto
                                <input type="file" name="foto" id="foto" class="hidden">
                            </label>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columna Derecha: Mascotas y Citas -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Sección Mascotas -->
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-orange-100 text-orange-600 p-2 rounded-lg"><i class="fas fa-paw"></i></span>
                        Mis Mascotas
                    </h2>
                    <!-- Botón oculto para usuarios normales, solo visible si decides activarlo después -->
                    {{-- <a href="{{ route('mascotas.create') }}" class="text-teal-600 hover:text-teal-700 text-sm font-medium">Nueva mascota</a> --}}
                </div>
                
                @if($mascotas->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500 text-sm">No tienes mascotas registradas.</p>
                        <p class="text-xs text-gray-400 mt-1">Contacta con la clínica para registrar una.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($mascotas as $mascota)
                        <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-100 hover:border-teal-200 bg-gray-50 hover:bg-teal-50 transition duration-200">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-2xl shadow-sm border border-gray-100">
                                {{ $mascota->tipo === 'Perro' ? '🐶' : ($mascota->tipo === 'Gato' ? '🐱' : '🐾') }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $mascota->nombre }}</h3>
                                <p class="text-xs text-gray-500">{{ $mascota->raza }} • {{ $mascota->edad }} años</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $mascota->genero }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Sección Historial de Citas -->
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                 <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-lg"><i class="fas fa-calendar-alt"></i></span>
                        Historial de Citas
                    </h2>
                    <a href="{{ route('citas.crear') }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow-sm">
                        Agendar Cita
                    </a>
                </div>

                @if($citas->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <p class="text-gray-500 text-sm">No has realizado ninguna cita aún.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-lg">Fecha</th>
                                    <th class="px-4 py-3">Mascota</th>
                                    <th class="px-4 py-3">Servicio</th>
                                    <th class="px-4 py-3 text-right">Estado</th>
                                    <th class="px-4 py-3 rounded-r-lg"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($citas as $cita)
                                <tr class="group hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($cita->fecha_preferida . ' ' . $cita->hora_preferida)->format('d M, Y - H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs">
                                                {{ $cita->tipo_mascota === 'Perro' ? '🐶' : ($cita->tipo_mascota === 'Gato' ? '🐱' : '🐾') }}
                                            </span>
                                            {{ $cita->nombre_mascota }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $cita->tipo_servicio }}</td>
                                    <td class="px-4 py-3 text-right">
                                        @if($cita->estado == 'pendiente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pendiente
                                            </span>
                                        @elseif($cita->estado == 'confirmado')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Confirmada
                                            </span>
                                        @elseif($cita->estado == 'completada')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                Completada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Finalizada
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if($cita->diagnostico || $cita->tratamiento)
                                            <button onclick="verHistorial('{{ addslashes($cita->diagnostico) }}', '{{ addslashes($cita->tratamiento) }}', '{{ $cita->veterinario ? addslashes($cita->veterinario->nombre) : 'N/A' }}')" 
                                                class="text-teal-600 hover:text-teal-800 font-bold text-xs underline cursor-pointer">
                                                Ver Informe
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <!-- Sección Historial de Pedidos -->
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                 <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg"><i class="fas fa-shopping-bag"></i></span>
                        Mis Pedidos
                    </h2>
                    <a href="{{ route('tienda') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        Ir a la Tienda
                    </a>
                </div>

                @if($orders->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <p class="text-gray-500 text-sm">No has realizado ningún pedido aún.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-lg">Pedido ID</th>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3 text-right">Estado</th>
                                    <th class="px-4 py-3 rounded-r-lg"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                <tr class="group hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        #{{ substr($order->id, 0, 8) }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $order->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="px-4 py-3 font-bold text-gray-900">
                                        {{ $order->total }} €
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if($order->status == 'completed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Completado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-xs text-indigo-600 font-bold hover:underline" onclick="alert('Detalles próximamente')">
                                            Ver Detalles
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function verHistorial(diagnostico, tratamiento, veterinario) {
        document.getElementById('modal-diagnostico').textContent = diagnostico || 'Sin diagnóstico registrado.';
        document.getElementById('modal-tratamiento').textContent = tratamiento || 'Sin tratamiento registrado.';
        document.getElementById('modal-veterinario').textContent = veterinario || 'No asignado';
        
        document.getElementById('historial-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function cerrarModal() {
        document.getElementById('historial-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar al hacer click fuera
    window.onclick = function(event) {
        const modal = document.getElementById('historial-modal');
        if (event.target == modal) {
            cerrarModal();
        }
    }
</script>
@endsection

<!-- Modal Historial Clínico -->
<div id="historial-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="cerrarModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-teal-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-notes-medical text-teal-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Historial Clínico
                        </h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Diagnóstico</h4>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg border border-gray-100 text-gray-700 text-sm" id="modal-diagnostico"></div>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Tratamiento</h4>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg border border-gray-100 text-gray-700 text-sm" id="modal-tratamiento"></div>
                            </div>

                            <div class="border-t border-gray-100 pt-3 mt-3">
                                <p class="text-xs text-gray-500">Atendido por: <span class="font-medium text-gray-700" id="modal-veterinario"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="cerrarModal()">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>
