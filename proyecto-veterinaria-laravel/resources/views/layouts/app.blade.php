<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASK!OTAS - Clínica Veterinaria</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script> <!-- Placeholder for icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-paw"></i> MASK!OTAS
            </a>
            
            <div class="hidden md:flex space-x-8 items-center font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-indigo-600 transition">Inicio</a>
                <a href="{{ url('/servicios') }}" class="hover:text-indigo-600 transition">Servicios</a>
                <a href="{{ url('/citas/crear') }}" class="hover:text-indigo-600 transition">Citas</a>
                <a href="{{ url('/resenas') }}" class="hover:text-indigo-600 transition">Reseñas</a>
                <a href="{{ url('/contacto') }}" class="hover:text-indigo-600 transition">Contacto</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    @if(Auth::user()->es_admin)
                        <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full text-sm font-bold transition">
                            📊 Admin
                        </a>
                    @endif
                    <span class="text-sm font-semibold text-gray-700">Hola, {{ Auth::user()->nombre }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold transition">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Ingresar</a>
                    <a href="{{ route('registro') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transform hover:scale-105 transition">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow">
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

</body>
</html>
