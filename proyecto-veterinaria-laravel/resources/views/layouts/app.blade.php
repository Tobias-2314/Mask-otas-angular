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

    {{-- Dynamic Font Loading --}}
    @php
        $fontFamily = $site_settings['font_family'] ?? 'Outfit';
        $googleFonts = [
            'Outfit' => 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap',
            'Roboto' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap',
            'Open Sans' => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap',
            'Merriweather' => 'https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap',
        ];
        $fontUrl = $googleFonts[$fontFamily] ?? $googleFonts['Outfit'];

        $fontSizeMap = [
            'small' => '14px',
            'medium' => '16px',
            'large' => '18px',
        ];
        $baseFontSize = $fontSizeMap[$site_settings['base_font_size'] ?? 'medium'] ?? '16px';

        $btnShape = $site_settings['button_shape'] ?? 'rounded'; // pill, square, rounded
        $btnRadius = match ($btnShape) {
            'pill' => '9999px',
            'square' => '0px',
            default => '0.5rem', // rounded-lg default
        };

        $shadowIntensity = $site_settings['card_shadow'] ?? 'shadow-lg'; // none, soft, medium, hard
        $shadowValue = match ($shadowIntensity) {
            'none' => 'none',
            'soft' => '0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)',
            'hard' => '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)',
            default => '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)', // medium/lg
        };
    @endphp
    <link href="{{ $fontUrl }}" rel="stylesheet">

    <style>
        :root {
            --color-primary:
                {{ $site_settings['primary_color'] ?? '#4F46E5' }}
            ;
            --color-secondary:
                {{ $site_settings['secondary_color'] ?? '#10B981' }}
            ;
            --color-bg:
                {{ $site_settings['background_color'] ?? '#F9FAFB' }}
            ;
            --color-header-bg:
                {{ $site_settings['header_bg_color'] ?? '#FFFFFF' }}
            ;
            --color-footer-bg:
                {{ $site_settings['footer_bg_color'] ?? '#111827' }}
            ;

            --btn-text-color:
                {{ $site_settings['button_text_color'] ?? '#FFFFFF' }}
            ;

            --dynamic-font: '{{ $fontFamily }}', sans-serif;
            --base-font-size:
                {{ $baseFontSize }}
            ;
            --btn-radius:
                {{ $btnRadius }}
            ;
            --card-shadow:
                {{ $shadowValue }}
            ;
        }

        body {
            font-family: var(--dynamic-font) !important;
            font-size: var(--base-font-size);
            background-color: var(--color-bg) !important;
        }

        /* Heading Color Override Removed */

        /* Button Overrides */
        button,
        .rounded-lg,
        .rounded-full,
        .rounded-md {
            /* Try to target buttons specifically if possible, or broad strokes for UI consistency */
        }

        /* Force Button Shape on common button classes */
        /* Force Button Shape on actual buttons/anchors */
        button.bg-indigo-600,
        a.bg-indigo-600,
        input.bg-indigo-600,
        button.bg-purple-600,
        a.bg-purple-600,
        button.bg-green-600,
        a.bg-green-600,
        button.bg-red-500,
        a.bg-red-500 {
            border-radius: var(--btn-radius) !important;
            color: var(--btn-text-color) !important;
        }

        /* Shadow Overrides */
        .shadow-lg,
        .shadow-md,
        .shadow-xl {
            box-shadow: var(--card-shadow) !important;
        }

        /* Shop Specifics */
        /* Shop Specifics Removed */

        /* Background Overrides */
        .bg-gray-50 {
            background-color: var(--color-bg) !important;
        }

        .bg-gray-100 {
            background-color: var(--color-bg) !important;
        }

        /* Nav & Footer */
        nav.bg-white {
            background-color: var(--color-header-bg) !important;
        }

        footer.bg-gray-900 {
            background-color: var(--color-footer-bg) !important;
        }

        .bg-gray-900 {
            background-color: var(--color-footer-bg) !important;
        }

        /* Primary Color Overrides (Indigo) */
        .bg-indigo-600 {
            background-color: var(--color-primary) !important;
        }

        .text-indigo-600 {
            color: var(--color-primary) !important;
        }

        .hover\:text-indigo-600:hover {
            color: var(--color-primary) !important;
        }

        .focus\:ring-indigo-500:focus {
            --tw-ring-color: var(--color-primary) !important;
        }

        .border-indigo-600 {
            border-color: var(--color-primary) !important;
        }

        .from-indigo-600 {
            --tw-gradient-from: var(--color-primary) !important;
        }

        .to-indigo-600 {
            --tw-gradient-to: var(--color-primary) !important;
        }

        .text-indigo-500 {
            color: var(--color-primary) !important;
        }

        /* Secondary Color Overrides (Green & Purple) */
        .bg-green-600 {
            background-color: var(--color-secondary) !important;
        }

        .text-green-600 {
            color: var(--color-secondary) !important;
        }

        .hover\:bg-green-700:hover {
            background-color: var(--color-secondary) !important;
            filter: brightness(0.9);
        }

        /* Map Purple to Secondary */
        .bg-purple-600 {
            background-color: var(--color-secondary) !important;
        }

        .text-purple-600 {
            color: var(--color-secondary) !important;
        }

        .hover\:bg-purple-700:hover {
            background-color: var(--color-secondary) !important;
            filter: brightness(0.9);
        }

        .from-purple-600 {
            --tw-gradient-from: var(--color-secondary) !important;
        }

        .to-purple-600 {
            --tw-gradient-to: var(--color-secondary) !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 z-50 bg-indigo-600 text-white p-3 rounded-lg font-bold shadow-lg transition">
        Saltar al contenido principal
    </a>

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50" aria-label="Navegación principal">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600 flex items-center gap-2"
                aria-label="MASK!OTAS - Ir al inicio">
                @if(isset($site_settings['logo_image']) && !empty($site_settings['logo_image']))
                    <img src="{{ $site_settings['logo_image'] }}" alt="Logo" class="h-10">
                @else
                    <i class="fas fa-paw" aria-hidden="true"></i> MASK!OTAS
                @endif
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-indigo-600 transition"
                    aria-current="{{ request()->is('/') ? 'page' : 'false' }}">Inicio</a>
                <a href="{{ route('tienda') }}" class="hover:text-indigo-600 transition"
                    aria-current="{{ request()->routeIs('tienda') ? 'page' : 'false' }}">Tienda</a>

                <a href="{{ url('/servicios') }}" class="hover:text-indigo-600 transition">Servicios</a>
                <a href="{{ url('/citas/crear') }}" class="hover:text-indigo-600 transition">Citas</a>
                <a href="{{ url('/resenas') }}" class="hover:text-indigo-600 transition">Reseñas</a>
                <a href="{{ url('/contacto') }}" class="hover:text-indigo-600 transition">Contacto</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @if(request()->routeIs('tienda') || request()->routeIs('cart.*'))
                    <a href="{{ route('cart.show') }}" id="cart-link" class="relative text-gray-600 hover:text-indigo-600 transition p-2"
                        aria-label="Carrito de compras">
                        <i class="fas fa-shopping-cart text-xl" aria-hidden="true"></i>
                        @if(session('cart'))
                            <span id="cart-count-badge"
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                @endif
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

                    <a href="{{ route('mi-cuenta') }}"
                        class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold transition"
                        aria-label="Mi cuenta">
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
                <button id="mobile-menu-btn" type="button"
                    class="text-gray-600 hover:text-indigo-600 focus:outline-none focus:text-indigo-600"
                    aria-label="Abrir menú de navegación">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 pb-4">
            <div class="flex flex-col space-y-2 px-6 pt-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Inicio</a>
                <a href="{{ route('tienda') }}"
                    class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Tienda</a>
                @if(request()->routeIs('tienda') || request()->routeIs('cart.*'))
                    <a href="{{ route('cart.show') }}"
                        class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Carrito @if(session('cart'))
                        ({{ count(session('cart')) }}) @endif</a>
                @endif
                <a href="{{ url('/servicios') }}"
                    class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Servicios</a>
                <a href="{{ url('/citas/crear') }}"
                    class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Citas</a>
                <a href="{{ url('/resenas') }}"
                    class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Reseñas</a>
                <a href="{{ url('/contacto') }}"
                    class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Contacto</a>
                <div class="border-t border-gray-100 pt-2 mt-2">
                    @auth
                        <a href="{{ route('mi-cuenta') }}"
                            class="block py-2 text-gray-600 hover:text-indigo-600 font-medium">Mi Cuenta</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left py-2 text-red-500 font-medium">Salir</button>
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
        @if(session('exito') && !request()->routeIs('admin.design'))
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
                <p class="text-gray-400">
                    {{ $site_settings['footer_text'] ?? 'Cuidamos a quienes más amas con tecnología de punta y amor incondicional.' }}
                </p>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Enlaces Rápidos</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-indigo-400">Nuestros Doctores</a></li>
                    <li><a href="{{ route('politica-privacidad') }}" class="hover:text-indigo-400">Política de Privacidad</a></li>
                    <li><a href="{{ route('politica-cookies') }}" class="hover:text-indigo-400">Política de Cookies</a></li>
                    <li><a href="{{ route('terminos-servicio') }}" class="hover:text-indigo-400">Términos de Servicio</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Contacto</h4>
                <p class="text-gray-400">
                    {{ $site_settings['footer_address'] ?? 'Calle Veterinaria 123, Madrid, España' }}
                </p>
                <p class="text-gray-400 font-bold mt-2">{{ $site_settings['footer_email'] ?? 'urgencias@maskotas.com' }}
                </p>
            </div>
        </div>
        <div class="text-center text-gray-600 mt-10 border-t border-gray-800 pt-6">
            &copy; 2026 MASK!OTAS. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Chatbot Flotante -->
    <div id="chatbot-button" class="fixed bottom-6 right-6 z-50">
        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110"
            aria-label="Abrir asistente virtual">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                </path>
            </svg>
        </button>
    </div>

    <!-- Contenedor del Chatbot -->
    <div id="chatbot-container"
        class="hidden fixed bottom-6 right-6 z-50 w-96 bg-white rounded-lg shadow-2xl overflow-hidden">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
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
                <input type="text" id="chatbot-input" placeholder="Escribe tu mensaje..."
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    maxlength="500" required>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-4 py-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Script del Chatbot y Mobile Menu -->
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>

    <!-- Banner de Cookies -->
    <div id="cookie-banner" class="hidden opacity-0 fixed bottom-0 left-0 right-0 bg-white border-t-4 border-indigo-600 shadow-2xl z-50 transition-opacity duration-300">
        <div class="container mx-auto px-4 py-6 md:px-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-cookie-bite text-indigo-600 text-3xl mt-1"></i>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">🍪 Este sitio utiliza cookies</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Utilizamos cookies propias y de terceros para mejorar tu experiencia de navegación, analizar el uso del sitio y personalizar contenidos. 
                                Al hacer clic en "Aceptar todo", consientes el uso de todas las cookies. Puedes gestionar tus preferencias en 
                                <a href="{{ route('politica-cookies') }}" class="text-indigo-600 hover:underline font-semibold">Política de Cookies</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <button id="reject-all-cookies" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition text-sm whitespace-nowrap">
                        Rechazar todo
                    </button>
                    <button id="configure-cookies" class="px-6 py-2.5 border-2 border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition text-sm whitespace-nowrap">
                        Configurar
                    </button>
                    <button id="accept-all-cookies" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition text-sm whitespace-nowrap shadow-lg">
                        Aceptar todo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Configuración de Cookies -->
    <div id="cookie-modal" class="hidden opacity-0 fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-cog text-3xl"></i>
                        <h2 class="text-2xl font-bold">Configuración de Cookies</h2>
                    </div>
                    <button id="close-cookie-modal" class="text-white hover:text-gray-200 transition">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <p class="mt-2 text-indigo-100 text-sm">Personaliza tus preferencias de cookies según tus necesidades</p>
            </div>

            <!-- Contenido -->
            <div class="p-6 space-y-6">
                <!-- Cookie Necesarias -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-shield-alt text-green-600"></i>
                                <h3 class="text-lg font-bold text-gray-900">Cookies Necesarias</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Siempre activas</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Estas cookies son esenciales para el funcionamiento del sitio web y no pueden desactivarse. 
                                Incluyen cookies de sesión, autenticación y seguridad.
                            </p>
                            <div class="mt-3 bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500"><strong>Ejemplos:</strong> PHPSESSID, XSRF-TOKEN, maskotas_session</p>
                                <p class="text-xs text-gray-500 mt-1"><strong>Duración:</strong> Sesión o hasta 2 horas</p>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="bg-green-100 rounded-full p-2">
                                <i class="fas fa-check text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cookies Funcionales -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-sliders-h text-blue-600"></i>
                                <h3 class="text-lg font-bold text-gray-900">Cookies Funcionales</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Permiten recordar tus preferencias (idioma, región, tema) y mejorar la funcionalidad del sitio. 
                                Sin estas cookies, algunas funciones pueden no estar disponibles.
                            </p>
                            <div class="mt-3 bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500"><strong>Ejemplos:</strong> Preferencias de idioma, tema oscuro/claro</p>
                                <p class="text-xs text-gray-500 mt-1"><strong>Duración:</strong> Hasta 1 año</p>
                            </div>
                        </div>
                        <div class="ml-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="cookie-functional" class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Cookies de Análisis -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-chart-line text-purple-600"></i>
                                <h3 class="text-lg font-bold text-gray-900">Cookies de Análisis</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Nos ayudan a entender cómo los visitantes interactúan con el sitio web, recopilando información de forma anónima. 
                                Utilizamos Google Analytics para mejorar nuestros servicios.
                            </p>
                            <div class="mt-3 bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500"><strong>Proveedores:</strong> Google Analytics, Google Tag Manager</p>
                                <p class="text-xs text-gray-500 mt-1"><strong>Duración:</strong> Hasta 2 años</p>
                            </div>
                        </div>
                        <div class="ml-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="cookie-analytics" class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Cookies de Marketing -->
                <div class="pb-2">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-bullhorn text-orange-600"></i>
                                <h3 class="text-lg font-bold text-gray-900">Cookies de Marketing</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Se utilizan para rastrear visitantes en diferentes sitios web y mostrar anuncios relevantes. 
                                Pueden ser establecidas por nuestros socios publicitarios.
                            </p>
                            <div class="mt-3 bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500"><strong>Proveedores:</strong> Google Ads, Facebook Pixel, LinkedIn Insight</p>
                                <p class="text-xs text-gray-500 mt-1"><strong>Duración:</strong> Hasta 2 años</p>
                            </div>
                        </div>
                        <div class="ml-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="cookie-marketing" class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-orange-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-2xl border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('politica-cookies') }}" class="text-sm text-indigo-600 hover:underline font-semibold">
                        <i class="fas fa-info-circle mr-1"></i>
                        Más información sobre cookies
                    </a>
                    <div class="flex gap-3 w-full sm:w-auto">
                        <button id="save-cookie-preferences" class="flex-1 sm:flex-none px-8 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition shadow-lg">
                            Guardar preferencias
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de Cookies -->
    <script src="{{ asset('js/cookies.js') }}"></script>

    @yield('scripts')
</body>

</html>