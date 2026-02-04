<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASK!OTAS - Clínica Veterinaria</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 z-50 bg-indigo-600 text-white p-3 rounded-lg font-bold shadow-lg transition">
        Saltar al contenido principal
    </a>

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50" aria-label="Navegación principal">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 flex items-center gap-2" aria-label="MASK!OTAS - Ir al inicio">
                <i class="fas fa-paw" aria-hidden="true"></i> MASK!OTAS
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-indigo-600 transition" aria-current="{{ request()->is('/') ? 'page' : 'false' }}">Inicio</a>
                <a href="{{ route('tienda') }}" class="hover:text-indigo-600 transition" aria-current="{{ request()->routeIs('tienda') ? 'page' : 'false' }}">Tienda</a>
                <a href="{{ route('cart.show') }}" class="hover:text-indigo-600 transition flex items-center" aria-label="Carrito de compras">
                    <i class="fas fa-shopping-cart mr-1" aria-hidden="true"></i> Carrito
                    @if(session('cart'))
                        <span class="ml-1 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
                <a href="{{ url('/servicios') }}" class="hover:text-indigo-600 transition">Servicios</a>
                <a href="{{ url('/citas/crear') }}" class="hover:text-indigo-600 transition">Citas</a>
                <a href="{{ url('/resenas') }}" class="hover:text-indigo-600 transition">Reseñas</a>
                <a href="{{ url('/contacto') }}" class="hover:text-indigo-600 transition">Contacto</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->es_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full text-sm font-bold transition">
                            📊 Admin
                        </a>
                    @endif
                    
                    @if(Auth::user()->role === 'veterinario')
                        <a href="{{ route('veterinario.index') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full text-sm font-bold transition">
                            🩺 Veterinario
                        </a>
                    @endif
                    
                    <a href="{{ route('mi-cuenta') }}" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold transition" aria-label="Mi cuenta">
                        <i class="fas fa-user-circle text-indigo-600" aria-hidden="true"></i>
                        <span>{{ Auth::user()->nombre }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold transition">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Ingresar</a>
                    <a href="{{ route('registro') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transform hover:scale-105 transition">
                        Registrarse
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" type="button" class="text-gray-600 hover:text-indigo-600 focus:outline-none focus:text-indigo-600" aria-label="Abrir menú de navegación">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 pb-4">
            <div class="flex flex-col space-y-2 px-6 pt-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Inicio</a>
                <a href="{{ route('tienda') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Tienda</a>
                <a href="{{ route('cart.show') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Carrito @if(session('cart')) ({{ count(session('cart')) }}) @endif</a>
                <a href="{{ url('/servicios') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Servicios</a>
                <a href="{{ url('/citas/crear') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Citas</a>
                <a href="{{ url('/resenas') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Reseñas</a>
                <a href="{{ url('/contacto') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Contacto</a>
                <div class="border-t border-gray-100 pt-2 mt-2">
                    @auth
                        <a href="{{ route('mi-cuenta') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Mi Cuenta</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left py-2 text-red-500 font-medium">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 text-indigo-600 font-bold">Ingresar</a>
                        <a href="{{ route('registro') }}" class="block py-2 text-indigo-600 font-bold">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow" id="main-content">
        @if(session('exito'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 container mx-auto mt-4" role="alert">
                <p class="font-bold">¡Éxito!</p>
                <p>{{ session('exito') }}</p>
            </div>
        @endif

        @yield('contenido')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-auto">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl font-bold mb-4">MASK!OTAS</h3>
                <p class="text-gray-400">Cuidamos a quienes más amas con tecnología de punta y amor incondicional.</p>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Enlaces Rápidos</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-indigo-400">Nuestros Doctores</a></li>
                    <li><a href="#" class="hover:text-indigo-400">Política de Privacidad</a></li>
                    <li><a href="#" class="hover:text-indigo-400">Términos de Servicio</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Contacto</h4>
                <p class="text-gray-400">Calle Veterinaria 123</p>
                <p class="text-gray-400">Madrid, España</p>
                <p class="text-gray-400 font-bold mt-2">urgencias@maskotas.com</p>
            </div>
        </div>
        <div class="text-center text-gray-600 mt-10 border-t border-gray-800 pt-6">
            &copy; 2026 MASK!OTAS. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Chatbot Flotante -->
    <div id="chatbot-button" class="fixed bottom-6 right-6 z-50">
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110" aria-label="Abrir asistente virtual">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
        </button>
    </div>

    <!-- Contenedor del Chatbot -->
    <div id="chatbot-container" class="hidden fixed bottom-6 right-6 z-50 w-96 bg-white rounded-lg shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <span class="text-indigo-600 font-bold text-lg">🐾</span>
                </div>
                <div>
                    <h3 class="font-bold">MaskBot</h3>
                    <p class="text-xs text-indigo-200">Asistente Virtual</p>
                </div>
            </div>
            <button id="chatbot-close" class="text-white hover:text-indigo-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mensajes -->
        <div id="chatbot-messages" class="h-96 overflow-y-auto p-4 bg-gray-50">
            <!-- Los mensajes se agregarán aquí dinámicamente -->
        </div>

        <!-- Input -->
        <form id="chatbot-form" class="border-t border-gray-200 p-4 bg-white">
            <div class="flex space-x-2">
                <label for="chatbot-input" class="sr-only">Escribe tu mensaje</label>
                <input 
                    type="text" 
                    id="chatbot-input" 
                    placeholder="Escribe tu mensaje..." 
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    maxlength="500"
                    required
                >
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-4 py-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Script del Chatbot y Mobile Menu -->
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>

</body>

</html>