@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        <!-- Info Column -->
        <div class="bg-indigo-600 text-white p-10 md:w-2/5 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-6">Contáctanos</h2>
            <p class="mb-8 text-indigo-100">Estamos aquí para resolver tus dudas. Visítanos o envíanos un mensaje.</p>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                    <span>Calle Veterinaria 123, Madrid</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-phone text-xl"></i>
                    <span>+34 912 345 678</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-envelope text-xl"></i>
                    <span>info@maskotas.com</span>
                </div>
            </div>
        </div>

        <!-- Form Column -->
        <div class="p-10 md:w-3/5">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Envíanos un mensaje</h3>
            <form action="#" method="POST"> <!-- Placeholder action -->
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 border p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" class="mt-1 block w-full rounded-md border-gray-300 border p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mensaje</label>
                        <textarea rows="4" class="mt-1 block w-full rounded-md border-gray-300 border p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <button type="button" class="w-full bg-gray-900 text-white font-bold py-3 rounded-lg hover:bg-gray-800 transition">
                        Enviar (Simulado)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
