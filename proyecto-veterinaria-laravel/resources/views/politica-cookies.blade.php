@extends('layouts.app')

@section('titulo', 'Política de Cookies - MASK!OTAS')

@section('contenido')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-4 rounded-xl">
                    <i class="fas fa-cookie-bite text-white text-4xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Política de Cookies</h1>
                    <p class="text-gray-600 mt-2">Última actualización: {{ date('d/m/Y') }}</p>
                </div>
            </div>
            <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-lg">
                <p class="text-gray-700 leading-relaxed">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i>
                    En <strong>MASK!OTAS</strong> utilizamos cookies y tecnologías similares para mejorar tu experiencia de navegación, 
                    analizar el tráfico del sitio y personalizar contenidos. Esta política explica qué son las cookies, 
                    cómo las utilizamos y cómo puedes gestionarlas.
                </p>
            </div>
        </div>

        <!-- Contenido -->
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            
            <!-- 1. ¿Qué son las cookies? -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-question-circle text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">1. ¿Qué son las cookies?</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-3">
                    <p>
                        Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo (ordenador, tablet, smartphone) 
                        cuando visitas un sitio web. Permiten que el sitio web recuerde tus acciones y preferencias 
                        (como inicio de sesión, idioma, tamaño de fuente y otras preferencias de visualización) durante un período de tiempo, 
                        para que no tengas que volver a configurarlas cada vez que regreses al sitio o navegues de una página a otra.
                    </p>
                    <p>
                        Las cookies pueden ser establecidas por el sitio web que estás visitando (<strong>cookies propias</strong>) 
                        o por terceros que proporcionan servicios al sitio web (<strong>cookies de terceros</strong>).
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 2. ¿Qué tipos de cookies utilizamos? -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-list-ul text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">2. ¿Qué tipos de cookies utilizamos?</h2>
                </div>
                
                <!-- Cookies Necesarias -->
                <div class="mb-6 border-l-4 border-green-500 bg-green-50 p-5 rounded-r-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                        <h3 class="text-xl font-bold text-gray-900">2.1. Cookies Necesarias (Técnicas)</h3>
                        <span class="bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">SIEMPRE ACTIVAS</span>
                    </div>
                    <p class="text-gray-700 mb-3">
                        Estas cookies son esenciales para el correcto funcionamiento del sitio web y no pueden ser desactivadas. 
                        Generalmente se establecen en respuesta a acciones realizadas por ti, como establecer tus preferencias de privacidad, 
                        iniciar sesión o completar formularios.
                    </p>
                    <div class="bg-white rounded-lg p-4 mt-3">
                        <h4 class="font-bold text-gray-900 mb-2">Cookies utilizadas:</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                                        <th class="px-4 py-2 text-left font-semibold">Finalidad</th>
                                        <th class="px-4 py-2 text-left font-semibold">Duración</th>
                                        <th class="px-4 py-2 text-left font-semibold">Tipo</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">PHPSESSID</td>
                                        <td class="px-4 py-2">Identificador de sesión del usuario</td>
                                        <td class="px-4 py-2">Sesión</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">XSRF-TOKEN</td>
                                        <td class="px-4 py-2">Protección contra ataques CSRF</td>
                                        <td class="px-4 py-2">2 horas</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">maskotas_session</td>
                                        <td class="px-4 py-2">Gestión de sesión de usuario</td>
                                        <td class="px-4 py-2">2 horas</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">maskotas_cookie_consent</td>
                                        <td class="px-4 py-2">Almacenar preferencias de cookies</td>
                                        <td class="px-4 py-2">1 año</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-3">
                        <strong>Base legal:</strong> Interés legítimo (Art. 6.1.f RGPD) - Necesarias para la prestación del servicio solicitado.
                    </p>
                </div>

                <!-- Cookies Funcionales -->
                <div class="mb-6 border-l-4 border-blue-500 bg-blue-50 p-5 rounded-r-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-sliders-h text-blue-600 text-xl"></i>
                        <h3 class="text-xl font-bold text-gray-900">2.2. Cookies Funcionales (Preferencias)</h3>
                        <span class="bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded">OPCIONAL</span>
                    </div>
                    <p class="text-gray-700 mb-3">
                        Estas cookies permiten que el sitio web recuerde las elecciones que haces (como tu nombre de usuario, idioma o región) 
                        y proporcionan características mejoradas y más personalizadas. También pueden utilizarse para recordar cambios 
                        que hayas realizado en el tamaño del texto, fuentes y otras partes personalizables del sitio web.
                    </p>
                    <div class="bg-white rounded-lg p-4 mt-3">
                        <h4 class="font-bold text-gray-900 mb-2">Cookies utilizadas:</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                                        <th class="px-4 py-2 text-left font-semibold">Finalidad</th>
                                        <th class="px-4 py-2 text-left font-semibold">Duración</th>
                                        <th class="px-4 py-2 text-left font-semibold">Tipo</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">user_language</td>
                                        <td class="px-4 py-2">Recordar preferencia de idioma</td>
                                        <td class="px-4 py-2">1 año</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">theme_preference</td>
                                        <td class="px-4 py-2">Recordar tema (claro/oscuro)</td>
                                        <td class="px-4 py-2">1 año</td>
                                        <td class="px-4 py-2">Propia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-3">
                        <strong>Base legal:</strong> Consentimiento (Art. 6.1.a RGPD).
                    </p>
                </div>

                <!-- Cookies de Análisis -->
                <div class="mb-6 border-l-4 border-purple-500 bg-purple-50 p-5 rounded-r-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                        <h3 class="text-xl font-bold text-gray-900">2.3. Cookies de Análisis (Analíticas)</h3>
                        <span class="bg-purple-600 text-white text-xs font-semibold px-2 py-1 rounded">OPCIONAL</span>
                    </div>
                    <p class="text-gray-700 mb-3">
                        Estas cookies nos permiten contar las visitas y fuentes de tráfico para poder medir y mejorar el rendimiento de nuestro sitio. 
                        Nos ayudan a saber qué páginas son las más y las menos populares, y a ver cómo se mueven los visitantes por el sitio. 
                        Toda la información que recogen estas cookies es agregada y, por lo tanto, anónima.
                    </p>
                    <div class="bg-white rounded-lg p-4 mt-3">
                        <h4 class="font-bold text-gray-900 mb-2">Cookies utilizadas:</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                                        <th class="px-4 py-2 text-left font-semibold">Proveedor</th>
                                        <th class="px-4 py-2 text-left font-semibold">Finalidad</th>
                                        <th class="px-4 py-2 text-left font-semibold">Duración</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">_ga</td>
                                        <td class="px-4 py-2">Google Analytics</td>
                                        <td class="px-4 py-2">Distinguir usuarios únicos</td>
                                        <td class="px-4 py-2">2 años</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">_ga_*</td>
                                        <td class="px-4 py-2">Google Analytics</td>
                                        <td class="px-4 py-2">Persistir estado de sesión</td>
                                        <td class="px-4 py-2">2 años</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">_gid</td>
                                        <td class="px-4 py-2">Google Analytics</td>
                                        <td class="px-4 py-2">Distinguir usuarios</td>
                                        <td class="px-4 py-2">24 horas</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">_gat</td>
                                        <td class="px-4 py-2">Google Analytics</td>
                                        <td class="px-4 py-2">Limitar tasa de solicitudes</td>
                                        <td class="px-4 py-2">1 minuto</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 p-3 bg-purple-100 rounded">
                            <p class="text-sm text-gray-700">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Más información: 
                                <a href="https://policies.google.com/technologies/cookies" target="_blank" rel="noopener noreferrer" class="text-purple-700 hover:underline font-semibold">
                                    Política de Cookies de Google
                                </a>
                            </p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-3">
                        <strong>Base legal:</strong> Consentimiento (Art. 6.1.a RGPD).
                    </p>
                </div>

                <!-- Cookies de Marketing -->
                <div class="mb-6 border-l-4 border-orange-500 bg-orange-50 p-5 rounded-r-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-bullhorn text-orange-600 text-xl"></i>
                        <h3 class="text-xl font-bold text-gray-900">2.4. Cookies de Marketing (Publicidad)</h3>
                        <span class="bg-orange-600 text-white text-xs font-semibold px-2 py-1 rounded">OPCIONAL</span>
                    </div>
                    <p class="text-gray-700 mb-3">
                        Estas cookies pueden ser establecidas a través de nuestro sitio por nuestros socios publicitarios. 
                        Pueden ser utilizadas por esas empresas para crear un perfil de tus intereses y mostrarte anuncios relevantes en otros sitios. 
                        No almacenan directamente información personal, sino que se basan en la identificación única de tu navegador y dispositivo de internet.
                    </p>
                    <div class="bg-white rounded-lg p-4 mt-3">
                        <h4 class="font-bold text-gray-900 mb-2">Cookies utilizadas:</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                                        <th class="px-4 py-2 text-left font-semibold">Proveedor</th>
                                        <th class="px-4 py-2 text-left font-semibold">Finalidad</th>
                                        <th class="px-4 py-2 text-left font-semibold">Duración</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">_fbp</td>
                                        <td class="px-4 py-2">Facebook</td>
                                        <td class="px-4 py-2">Seguimiento de conversiones</td>
                                        <td class="px-4 py-2">3 meses</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">fr</td>
                                        <td class="px-4 py-2">Facebook</td>
                                        <td class="px-4 py-2">Publicidad personalizada</td>
                                        <td class="px-4 py-2">3 meses</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">IDE</td>
                                        <td class="px-4 py-2">Google Ads</td>
                                        <td class="px-4 py-2">Remarketing y publicidad</td>
                                        <td class="px-4 py-2">1 año</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-mono text-xs">li_sugr</td>
                                        <td class="px-4 py-2">LinkedIn</td>
                                        <td class="px-4 py-2">Seguimiento de conversiones</td>
                                        <td class="px-4 py-2">3 meses</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-3">
                        <strong>Base legal:</strong> Consentimiento (Art. 6.1.a RGPD).
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 3. ¿Cómo gestionar las cookies? -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-cog text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">3. ¿Cómo gestionar las cookies?</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <p>
                        Tienes varias opciones para gestionar las cookies. Cualquier cambio que realices en tus preferencias de cookies 
                        solo se aplicará al sitio web que estás visitando actualmente.
                    </p>

                    <div class="bg-indigo-50 p-5 rounded-lg">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">
                            <i class="fas fa-hand-pointer text-indigo-600 mr-2"></i>
                            A) Panel de Configuración de Cookies
                        </h3>
                        <p class="mb-3">
                            Puedes gestionar tus preferencias de cookies en cualquier momento haciendo clic en el siguiente botón:
                        </p>
                        <button onclick="window.cookieManager.openSettings()" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition shadow-lg">
                            <i class="fas fa-cookie-bite mr-2"></i>
                            Configurar Cookies
                        </button>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">
                            <i class="fas fa-browser text-gray-600 mr-2"></i>
                            B) Configuración del Navegador
                        </h3>
                        <p class="mb-3">
                            La mayoría de los navegadores web permiten cierto control de las cookies a través de la configuración del navegador. 
                            A continuación, te proporcionamos enlaces a las instrucciones de los navegadores más populares:
                        </p>
                        <ul class="space-y-2">
                            <li>
                                <a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                                    <i class="fab fa-chrome mr-2"></i>Google Chrome
                                </a>
                            </li>
                            <li>
                                <a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                                    <i class="fab fa-firefox mr-2"></i>Mozilla Firefox
                                </a>
                            </li>
                            <li>
                                <a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                                    <i class="fab fa-safari mr-2"></i>Safari
                                </a>
                            </li>
                            <li>
                                <a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                                    <i class="fab fa-edge mr-2"></i>Microsoft Edge
                                </a>
                            </li>
                            <li>
                                <a href="https://help.opera.com/en/latest/web-preferences/#cookies" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                                    <i class="fab fa-opera mr-2"></i>Opera
                                </a>
                            </li>
                        </ul>
                        <div class="mt-4 p-3 bg-yellow-100 border-l-4 border-yellow-500 rounded-r">
                            <p class="text-sm text-gray-700">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                                <strong>Importante:</strong> Si bloqueas o eliminas las cookies necesarias, es posible que algunas partes del sitio web 
                                no funcionen correctamente y que tengas que ajustar manualmente algunas preferencias cada vez que visites el sitio.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 4. Transferencias internacionales -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-globe text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">4. Transferencias Internacionales de Datos</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Algunos de nuestros proveedores de servicios de cookies (como Google Analytics, Facebook, LinkedIn) 
                        pueden transferir datos fuera del Espacio Económico Europeo (EEE). Estas transferencias se realizan con las siguientes garantías:
                    </p>
                    <ul class="list-disc list-inside space-y-2 mt-3">
                        <li><strong>Cláusulas Contractuales Tipo (CCT)</strong> aprobadas por la Comisión Europea</li>
                        <li><strong>Decisiones de Adecuación</strong> de la Comisión Europea para ciertos países</li>
                        <li><strong>Certificaciones</strong> como el EU-U.S. Data Privacy Framework</li>
                        <li><strong>Medidas técnicas y organizativas</strong> adicionales para garantizar la seguridad de los datos</li>
                    </ul>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 5. Actualización de la política -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-sync-alt text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">5. Actualización de esta Política</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Podemos actualizar esta Política de Cookies periódicamente para reflejar cambios en las cookies que utilizamos 
                        o por otras razones operativas, legales o reglamentarias. Te recomendamos que revises esta política regularmente 
                        para estar informado sobre cómo utilizamos las cookies.
                    </p>
                    <p class="mt-3">
                        La fecha de la última actualización se indica en la parte superior de esta política.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 6. Contacto -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">6. Contacto</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Si tienes alguna pregunta sobre esta Política de Cookies o sobre cómo gestionamos las cookies, 
                        puedes contactarnos en:
                    </p>
                    <div class="bg-gray-50 p-5 rounded-lg mt-4 space-y-2">
                        <p><strong>MASK!OTAS - Servicios Veterinarios S.L.</strong></p>
                        <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Calle Veterinaria, 123, 28001 Madrid, España</p>
                        <p><i class="fas fa-envelope text-indigo-600 mr-2"></i>Email: <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a></p>
                        <p><i class="fas fa-phone text-indigo-600 mr-2"></i>Teléfono: <a href="tel:+34911234567" class="text-indigo-600 hover:underline">+34 911 234 567</a></p>
                        <p><i class="fas fa-user-shield text-indigo-600 mr-2"></i>Delegado de Protección de Datos: <a href="mailto:dpo@maskotas.com" class="text-indigo-600 hover:underline">dpo@maskotas.com</a></p>
                    </div>
                </div>
            </section>

        </div>

        <!-- Footer de la página -->
        <div class="mt-8 text-center">
            <a href="{{ route('politica-privacidad') }}" class="text-indigo-600 hover:underline font-semibold">
                <i class="fas fa-shield-alt mr-2"></i>
                Ver Política de Privacidad
            </a>
        </div>
    </div>
</div>
@endsection
