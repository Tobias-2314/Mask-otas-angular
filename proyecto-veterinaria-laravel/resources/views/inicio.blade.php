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
                <a href="{{ url('/citas/crear') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-full font-bold text-lg shadow-xl hover:bg-gray-100 transition transform hover:-translate-y-1">
                    Agendar Cita
                </a>
                <a href="{{ url('/servicios') }}" class="border-2 border-white text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-white hover:text-indigo-600 transition">
                    Ver Servicios
                </a>
            </div>
        </div>
        <!-- Placeholder Image -->
        <div class="md:w-1/2 mt-12 md:mt-0 relative">
            <!-- Usar componente de imagen o asset real -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-6 shadow-2xl transform rotate-3">
                <div class="bg-gray-300 rounded-2xl h-80 w-full flex items-center justify-center text-gray-500 text-2xl font-bold">
                    [Imagen Mascota Feliz]
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">¿Por qué elegirnos?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Combinamos experiencia médica con un trato humano y cercano para que tú y tu mascota se sientan en casa.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-gray-100 hover:border-indigo-100 group">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                    ❤️
                </div>
                <h3 class="text-xl font-bold mb-3">Atención con Amor</h3>
                <p class="text-gray-600">Tratamos a cada paciente como si fuera nuestra propia mascota, con paciencia y cariño.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="p-8 rounded-2xl bg-gray-50 hover:bg-purple-50 transition border border-gray-100 hover:border-purple-100 group">
                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                    🩺
                </div>
                <h3 class="text-xl font-bold mb-3">Tecnología Avanzada</h3>
                <p class="text-gray-600">Equipos de diagnóstico de última generación para resultados precisos y rápidos.</p>
            </div>

            <!-- Feature 3 -->
            <div class="p-8 rounded-2xl bg-gray-50 hover:bg-pink-50 transition border border-gray-100 hover:border-pink-100 group">
                <div class="w-14 h-14 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">
                    📅
                </div>
                <h3 class="text-xl font-bold mb-3">Citas Flexibles</h3>
                <p class="text-gray-600">Horarios extendidos y sistema de reservas online para tu máxima comodidad.</p>
            </div>
        </div>
    </div>
</section>

@endsection
