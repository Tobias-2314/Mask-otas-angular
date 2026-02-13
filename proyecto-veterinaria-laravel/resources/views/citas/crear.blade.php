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
                        <input type="text" name="nombre_dueno" value="{{ Auth::check() ? Auth::user()->nombre : '' }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                <select name="prefijo"
                                    class="bg-transparent border-none focus:ring-0 p-0 text-gray-700 h-full">
                                    <option value="+34">🇪🇸 +34</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+49">🇩🇪 +49</option>
                                    <option value="+39">🇮🇹 +39</option>
                                    <option value="+351">🇵🇹 +351</option>
                                </select>
                            </span>
                            <input type="tel" name="telefono"
                                class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                                placeholder="600123456" pattern="[0-9]+" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
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
                            <select name="mascota_id" id="mascota_select"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                                onchange="autoFillMascota()">
                                <option value="">-- Seleccionar Mascota Registrada --</option>
                                @foreach($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}" data-nombre="{{ $mascota->nombre }}"
                                        data-tipo="{{ $mascota->tipo }}">
                                        {{ $mascota->nombre }} ({{ $mascota->tipo }})
                                    </option>
                                @endforeach
                                <option value="">-- Otra / No Registrada --</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Selecciona una mascota o ingresa los datos manualmente.</p>
                        @else
                            <p class="text-sm text-gray-500 mt-2">
                                <a href="{{ route('mascotas.create') }}" class="text-indigo-600 hover:underline">Registra tus
                                    mascotas</a> para agendar más rápido.
                            </p>
                        @endif
                    </div>

                    <div id="manual_pet_fields" class="contents">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre Mascota</label>
                            <input type="text" name="nombre_mascota" id="nombre_mascota"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo de Mascota</label>
                            <select name="tipo_mascota" id="tipo_mascota"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                                <option value="">-- Seleccionar --</option>
                                <option value="Perro">Perro</option>
                                <option value="Gato">Gato</option>
                                <option value="Ave">Ave</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Servicio</label>
                        <select name="tipo_servicio"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                            <option>Consulta General</option>
                            <option>Vacunación</option>
                            <option>Desparasitación</option>
                            <option>Cirugía</option>
                            <option>Peluquería</option>
                        </select>
                    </div>

                    <!-- Selección de Fecha y Hora Visual -->
                    <div class="col-span-2 mt-4">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Selecciona Fecha y Hora</h3>

                        <!-- Selector de Fecha (Calendario) -->
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de la Cita</label>
                        <input type="date" name="fecha_preferida" id="input_fecha"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3 mb-6 cursor-pointer"
                            required onchange="seleccionarFecha(this.value)" oninput="seleccionarFecha(this.value)">

                        <!-- Input Oculto para la Hora (Mantenemos este) -->
                        <input type="hidden" name="hora_preferida" id="input_hora" required>

                        <!-- Selector de Horas (Grid) -->
                        <label class="block text-sm font-medium text-gray-700 mb-2">Horarios Disponibles</label>
                        <div id="time-slots" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <p class="text-gray-500 text-sm italic col-span-2">Selecciona una fecha en el calendario para
                                ver horarios.</p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Notas Adicionales</label>
                        <textarea name="notas" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"></textarea>
                    </div>
                </div>

                <div class="flex justify-end p-4">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-indigo-700 transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submit-btn" disabled>
                        Confirmar Cita
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Variables Globales
        let citasOcupadas = [];
        let fechaSeleccionada = null;

        const horasDisponibles = [
            '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
            '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30',
            '18:00', '18:30', '19:00', '19:30', '20:00'
        ];

        // Función Global - Invocada desde HTML (onchange)
        function seleccionarFecha(fechaStr) {
            console.log('Function seleccionarFecha called with:', fechaStr);

            if (!fechaStr) {
                console.warn('Fecha vacía/nula');
                return;
            }

            fechaSeleccionada = fechaStr;

            // Resetear inputs dependientes
            const inputHora = document.getElementById('input_hora');
            const submitBtn = document.getElementById('submit-btn');

            if (inputHora) inputHora.value = '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Confirmar Cita';
            }

            renderHoras(fechaStr);
        }

        // Función Global - Renderizado
        function renderHoras(fechaStr) {
            console.log('Rendering hours for:', fechaStr);
            const container = document.getElementById('time-slots');

            if (!container) {
                console.error('Container #time-slots not found!');
                return;
            }

            // Limpiar contenedor inmediatamente
            container.innerHTML = '';

            // Generar botones
            horasDisponibles.forEach(hora => {
                // Verificar ocupación
                const ocupada = citasOcupadas.some(cita => {
                    return cita.fecha_preferida === fechaStr &&
                        String(cita.hora_preferida).startsWith(hora.substring(0, 5));
                });

                const btn = document.createElement('button');
                btn.type = 'button';
                // Prevenir submit del form

                if (ocupada) {
                    btn.className = 'w-full py-4 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed flex items-center justify-center font-semibold border border-gray-200';
                    btn.innerHTML = `<span>${hora}</span> <span class="ml-2 text-xs">(Ocupado)</span>`;
                    btn.disabled = true;
                } else {
                    btn.className = 'w-full py-4 rounded-lg bg-teal-600 text-white font-bold shadow-md hover:bg-teal-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2';
                    btn.innerText = hora;
                    btn.onclick = function () { seleccionarHora(this, hora); };
                }

                container.appendChild(btn);
            });

            if (container.children.length === 0) {
                container.innerHTML = '<p class="text-red-500 col-span-2">No hay horarios disponibles.</p>';
            }
        }

        function seleccionarHora(btn, hora) {
            console.log('Hora seleccionada:', hora);

            // Resetear estilos
            const allBtns = document.querySelectorAll('#time-slots button:not([disabled])');
            allBtns.forEach(b => {
                b.classList.remove('ring-4', 'ring-yellow-400', 'bg-teal-800');
                b.classList.add('bg-teal-600');
            });

            // Estilo activo
            btn.classList.remove('bg-teal-600');
            btn.classList.add('bg-teal-800', 'ring-4', 'ring-yellow-400');

            // Actualizar formulario
            const inputHora = document.getElementById('input_hora');
            const submitBtn = document.getElementById('submit-btn');

            if (inputHora) inputHora.value = hora;
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerText = `Confirmar: ${fechaSeleccionada} a las ${hora}`;
            }
        }

        // Inicialización al cargar el DOM
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM Ready');
            const inputFecha = document.getElementById('input_fecha');

            // Establecer mínimo (Hoy)
            try {
                const hoy = new Date();
                const year = hoy.getFullYear();
                const month = String(hoy.getMonth() + 1).padStart(2, '0');
                const day = String(hoy.getDate()).padStart(2, '0');
                if (inputFecha) inputFecha.min = `${year}-${month}-${day}`;
            } catch (e) { console.error(e); }

            // Fetch de citas ocupadas
            fetch("{{ route('citas.ocupadas') }}")
                .then(res => res.json())
                .then(data => {
                    citasOcupadas = Array.isArray(data) ? data : [];
                    console.log('Citas ocupadas cargadas:', citasOcupadas);

                    // Si el navegador autocompletó la fecha, renderizar ya
                    if (inputFecha && inputFecha.value) {
                        seleccionarFecha(inputFecha.value);
                    }
                })
                .catch(err => console.error('Error API:', err));

            autoFillMascota();
        });

        function autoFillMascota() {
            // Lógica de mascotas (Mantenida igual pero simplificada por brevedad si no se cambia)
            const select = document.getElementById('mascota_select');
            const manualFields = document.getElementById('manual_pet_fields');
            const nombreInput = document.getElementById('nombre_mascota');
            const tipoInput = document.getElementById('tipo_mascota');

            if (!manualFields) return;
            if (!select) {
                manualFields.classList.remove('hidden');
                return;
            }
            if (select.value) {
                manualFields.classList.add('hidden');
                if (nombreInput) nombreInput.value = '';
                if (tipoInput) tipoInput.value = '';
            } else {
                manualFields.classList.remove('hidden');
            }
        }
    </script>
@endsection