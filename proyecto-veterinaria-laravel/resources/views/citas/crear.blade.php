@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Agendar Cita</h2>
        
        <form action="{{ route('citas.guardar') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Datos del Dueño -->
                <div class="col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Datos del Dueño</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                    <input type="text" name="nombre_dueno" value="{{ Auth::check() ? Auth::user()->nombre : '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="tel" name="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Datos de la Mascota y Cita -->
                <div class="col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Datos de la Cita</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mascota</label>
                    @if(count($mascotas) > 0)
                        <select name="mascota_id" id="mascota_select" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" onchange="autoFillMascota()">
                            <option value="">-- Seleccionar Mascota Registrada --</option>
                            @foreach($mascotas as $mascota)
                                <option value="{{ $mascota->id }}" data-nombre="{{ $mascota->nombre }}" data-tipo="{{ $mascota->tipo }}">
                                    {{ $mascota->nombre }} ({{ $mascota->tipo }})
                                </option>
                            @endforeach
                            <option value="">-- Otra / No Registrada --</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Selecciona una mascota o ingresa los datos manualmente.</p>
                    @else
                        <p class="text-sm text-gray-500 mt-2">
                            <a href="{{ route('mascotas.create') }}" class="text-indigo-600 hover:underline">Registra tus mascotas</a> para agendar más rápido.
                        </p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre Mascota</label>
                    <input type="text" name="nombre_mascota" id="nombre_mascota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo de Mascota</label>
                    <select name="tipo_mascota" id="tipo_mascota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                        <option value="">-- Seleccionar --</option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
                        <option value="Ave">Ave</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Servicio</label>
                    <select name="tipo_servicio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                        <option>Consulta General</option>
                        <option>Vacunación</option>
                        <option>Desparasitación</option>
                        <option>Cirugía</option>
                        <option>Peluquería</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha Preferida</label>
                    <input type="date" name="fecha_preferida" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Hora Preferida</label>
                    <input type="time" name="hora_preferida" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Notas Adicionales</label>
                    <textarea name="notas" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"></textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-full font-bold shadow-lg hover:bg-indigo-700 transition transform hover:scale-105">
                    Confirmar Cita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function autoFillMascota() {
        const select = document.getElementById('mascota_select');
        const nombreInput = document.getElementById('nombre_mascota');
        const tipoInput = document.getElementById('tipo_mascota');
        
        const selectedOption = select.options[select.selectedIndex];
        
        if (selectedOption.value) {
            nombreInput.value = selectedOption.getAttribute('data-nombre');
            tipoInput.value = selectedOption.getAttribute('data-tipo');
            // Opcional: Deshabilitar campos para evitar edición conflictiva
            // nombreInput.readOnly = true;
            // tipoInput.disabled = true; 
        } else {
            nombreInput.value = '';
            tipoInput.value = '';
            // nombreInput.readOnly = false;
            // tipoInput.disabled = false;
        }
    }
</script>
@endsection
