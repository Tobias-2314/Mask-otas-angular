@extends('layouts.app')

@section('contenido')

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-6 py-24 md:py-32 relative z-10 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                    Tu mascota, <br> nuestra prioridad.
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 mb-8 max-w-lg mx-auto md:mx-0">
                    Servicios veterinarios de primera clase con un equipo apasionado por el bienestar animal.
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ url('/citas/crear') }}"
                        class="bg-white text-indigo-600 px-8 py-3 rounded-full font-bold text-lg shadow-xl hover:bg-gray-100 transition transform hover:-translate-y-1">
                        Agendar Cita
                    </a>
                    <a href="{{ url('/servicios') }}"
                        class="border-2 border-white text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-white hover:text-indigo-600 transition">
                        Ver Servicios
                    </a>
                </div>
            </div>
            <!-- Placeholder Image -->
            <div class="md:w-1/2 mt-12 md:mt-0 relative">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-6 shadow-2xl transform rotate-3">
                    <img src="{{ asset('images/hero_mascota.png') }}"
                        alt="Perro golden retriever y gato naranja recibiendo atención veterinaria en una clínica moderna"
                        class="rounded-2xl w-full h-80 object-cover shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">¿Por qué elegirnos?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Combinamos experiencia médica con un trato humano y cercano para
                    que tú y tu mascota se sientan en casa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-gray-100 hover:border-indigo-100 group">
                    <div
                        class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                        ❤️
                    </div>
                    <h3 class="text-xl font-bold mb-3">Atención con Amor</h3>
                    <p class="text-gray-600">Tratamos a cada paciente como si fuera nuestra propia mascota, con paciencia y
                        cariño.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 hover:bg-purple-50 transition border border-gray-100 hover:border-purple-100 group">
                    <div
                        class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                        🩺
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tecnología Avanzada</h3>
                    <p class="text-gray-600">Equipos de diagnóstico de última generación para resultados precisos y rápidos.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 hover:bg-pink-50 transition border border-gray-100 hover:border-pink-100 group">
                    <div
                        class="w-14 h-14 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                        📅
                    </div>
                    <h3 class="text-xl font-bold mb-3">Citas Flexibles</h3>
                    <p class="text-gray-600">Horarios extendidos y sistema de reservas online para tu máxima comodidad.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Clientes Felices</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Estas son algunas de las experiencias de nuestros clientes más
                    recientes.</p>
            </div>

            <!-- Container for Reviews -->
            <div id="resenas-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16"
                aria-live="polite">
                @foreach($resenas as $resena)
                    <div
                        class="bg-white p-6 rounded-2xl shadow-xl shadow-indigo-100/50 border border-gray-100 transform hover:-translate-y-1 transition duration-300">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 0; $i < $resena->calificacion; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for($i = $resena->calificacion; $i < 5; $i++)
                                    <i class="far fa-star text-gray-300"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 italic mb-6 line-clamp-3">"{{ $resena->comentario }}"</p>
                        <div class="flex items-center gap-3 mt-auto">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                {{ substr($resena->usuario->nombre ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $resena->usuario->nombre ?? 'Anónimo' }}</p>
                                <p class="text-xs text-indigo-500 font-semibold">{{ $resena->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Script for AJAX Reviews -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Polling System to Auto-Update Reviews (every 3 seconds)
                    setInterval(() => {
                        fetch('/api/ultimas-resenas')
                            .then(response => response.json())
                            .then(data => {
                                const container = document.getElementById('resenas-container');

                                // Clear container
                                container.innerHTML = '';

                                data.forEach(resena => {
                                    let starsHtml = '';
                                    for (let i = 0; i < resena.calificacion; i++) starsHtml += '<i class="fas fa-star"></i> ';
                                    for (let i = resena.calificacion; i < 5; i++) starsHtml += '<i class="far fa-star text-gray-300"></i> ';

                                    const nombreUsuario = resena.usuario ? resena.usuario.nombre : 'Usuario';
                                    const inicial = nombreUsuario.charAt(0);

                                    const cardHtml = `
                                        <div class="bg-white p-6 rounded-2xl shadow-xl shadow-indigo-100/50 border border-gray-100 transform hover:-translate-y-1 transition duration-300">
                                            <div class="flex items-center mb-4">
                                                <div class="flex text-yellow-400 text-sm">
                                                    ${starsHtml}
                                                </div>
                                            </div>
                                            <p class="text-gray-600 italic mb-6 line-clamp-3">"${resena.comentario}"</p>
                                            <div class="flex items-center gap-3 mt-auto">
                                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                                    ${inicial}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900">${nombreUsuario}</p>
                                                    <p class="text-xs text-indigo-500 font-semibold">Hace un momento</p>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    container.insertAdjacentHTML('beforeend', cardHtml);
                                });
                            })
                            .catch(error => console.error('Error fetching reviews:', error));
                    }, 3000); // 3 seconds
                });
            </script>

            <style>
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translate3d(0, 20px, 0);
                    }

                    to {
                        opacity: 1;
                        transform: translate3d(0, 0, 0);
                    }
                }

                .animate-fade-in-up {
                    animation: fadeInUp 0.5s ease-out forwards;
                }
            </style>

@endsection