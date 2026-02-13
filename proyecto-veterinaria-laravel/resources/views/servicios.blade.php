@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nuestros Servicios</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Ofrecemos una gama completa de servicios veterinarios para garantizar
                la salud y felicidad de tu mascota.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Servicio 1 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition">
                <div class="h-48 bg-indigo-100 flex items-center justify-center text-6xl">
                    🩺
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-indigo-600 transition">Consulta General</h3>
                    <p class="text-gray-600 mb-4">Chequeos rutinarios y diagnóstico integral para mantener a tu mascota en
                        perfecto estado.</p>
                    <a href="{{ route('citas.crear') }}" class="text-indigo-600 font-bold hover:underline">Agendar
                        &rarr;</a>
                </div>
            </div>

            <!-- Servicio 2 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition">
                <div class="h-48 bg-purple-100 flex items-center justify-center text-6xl">
                    💉
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-purple-600 transition">Vacunación</h3>
                    <p class="text-gray-600 mb-4">Protege a tu mejor amigo contra enfermedades comunes con nuestro esquema
                        de vacunación.</p>
                    <a href="{{ route('citas.crear') }}" class="text-indigo-600 font-bold hover:underline">Agendar
                        &rarr;</a>
                </div>
            </div>

            <!-- Servicio 3 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition">
                <div class="h-48 bg-pink-100 flex items-center justify-center text-6xl">
                    ✂️
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-pink-600 transition">Peluquería & Spa</h3>
                    <p class="text-gray-600 mb-4">Baños, cortes y tratamientos estéticos para que tu mascota luzca
                        increíble.</p>
                    <a href="{{ route('citas.crear') }}" class="text-indigo-600 font-bold hover:underline">Agendar
                        &rarr;</a>
                </div>
            </div>
        </div>
    </div>
@endsection