@extends('layouts.app')

@section('contenido')
<div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-16">
    <div class="container mx-auto px-6 max-w-5xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Política de Privacidad y Protección de Datos
            </h1>
            <p class="text-gray-600 text-lg">
                <i class="fas fa-shield-alt text-indigo-600 mr-2"></i>
                Última actualización: 10 de febrero de 2026
            </p>
        </div>

        <!-- Contenido Principal -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
            <!-- Sección 1: Responsable del Tratamiento -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-building mr-3"></i>
                    1. Responsable del Tratamiento
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p>En cumplimiento de lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (en adelante, "RGPD"), y en la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales (en adelante, "LOPDGDD"), se informa a los usuarios del sitio web que el responsable del tratamiento de sus datos personales es:</p>
                    
                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-6 my-6 rounded-r-lg">
                        <p class="font-semibold mb-2"><strong>Denominación social:</strong> MASK!OTAS - Servicios Veterinarios S.L.</p>
                        <p class="mb-2"><strong>CIF/NIF:</strong> B-87654321</p>
                        <p class="mb-2"><strong>Domicilio social:</strong> Calle Veterinaria, 123, 28001 Madrid, España</p>
                        <p class="mb-2"><strong>Correo electrónico:</strong> <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a></p>
                        <p class="mb-2"><strong>Teléfono:</strong> +34 911 234 567</p>
                        <p><strong>Delegado de Protección de Datos:</strong> <a href="mailto:dpo@maskotas.com" class="text-indigo-600 hover:underline">dpo@maskotas.com</a></p>
                    </div>
                </div>
            </section>

            <!-- Sección 2: Finalidad del Tratamiento -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-bullseye mr-3"></i>
                    2. Finalidad del Tratamiento de Datos Personales
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p>Los datos personales que el usuario facilite a través de este sitio web serán tratados con las siguientes finalidades:</p>
                    
                    <div class="grid md:grid-cols-2 gap-4 my-6">
                        <div class="bg-blue-50 p-5 rounded-lg border border-blue-200">
                            <h3 class="font-bold text-blue-900 mb-2"><i class="fas fa-calendar-check mr-2"></i>Gestión de citas veterinarias</h3>
                            <p class="text-sm text-gray-700">Programación y seguimiento de citas, prestación de servicios clínicos y asistenciales.</p>
                        </div>
                        <div class="bg-green-50 p-5 rounded-lg border border-green-200">
                            <h3 class="font-bold text-green-900 mb-2"><i class="fas fa-shopping-cart mr-2"></i>Gestión de pedidos</h3>
                            <p class="text-sm text-gray-700">Procesamiento de pedidos, pagos, facturación y envío de productos personalizados.</p>
                        </div>
                        <div class="bg-purple-50 p-5 rounded-lg border border-purple-200">
                            <h3 class="font-bold text-purple-900 mb-2"><i class="fas fa-file-medical mr-2"></i>Historial médico</h3>
                            <p class="text-sm text-gray-700">Registro y mantenimiento del historial clínico de las mascotas.</p>
                        </div>
                        <div class="bg-yellow-50 p-5 rounded-lg border border-yellow-200">
                            <h3 class="font-bold text-yellow-900 mb-2"><i class="fas fa-user-circle mr-2"></i>Gestión de usuarios</h3>
                            <p class="text-sm text-gray-700">Creación y mantenimiento de cuentas, autenticación y perfiles.</p>
                        </div>
                        <div class="bg-pink-50 p-5 rounded-lg border border-pink-200">
                            <h3 class="font-bold text-pink-900 mb-2"><i class="fas fa-envelope mr-2"></i>Comunicaciones comerciales</h3>
                            <p class="text-sm text-gray-700">Envío de newsletters, promociones y ofertas (con consentimiento).</p>
                        </div>
                        <div class="bg-indigo-50 p-5 rounded-lg border border-indigo-200">
                            <h3 class="font-bold text-indigo-900 mb-2"><i class="fas fa-chart-line mr-2"></i>Mejora de la experiencia</h3>
                            <p class="text-sm text-gray-700">Análisis de navegación para optimizar funcionalidad y contenidos.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección 3: Legitimación -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-gavel mr-3"></i>
                    3. Legitimación del Tratamiento
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p>La base jurídica que legitima el tratamiento de los datos personales se fundamenta en:</p>
                    <ul class="space-y-3 my-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <span><strong>Consentimiento del interesado (Art. 6.1.a RGPD):</strong> Para comunicaciones comerciales, newsletters y cookies no esenciales.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <span><strong>Ejecución de un contrato (Art. 6.1.b RGPD):</strong> Para gestión de citas, pedidos y servicios contratados.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <span><strong>Cumplimiento de obligaciones legales (Art. 6.1.c RGPD):</strong> Para obligaciones fiscales, contables y sanitarias.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <span><strong>Interés legítimo (Art. 6.1.f RGPD):</strong> Para mejora de servicios, prevención del fraude y seguridad.</span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Sección 4: Categorías de Datos -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-database mr-3"></i>
                    4. Categorías de Datos Personales Tratados
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <div class="bg-gray-50 p-6 rounded-lg my-4">
                        <h3 class="font-bold text-gray-900 mb-3"><i class="fas fa-id-card mr-2 text-indigo-600"></i>Datos Identificativos</h3>
                        <p class="text-sm">Nombre, apellidos, DNI, dirección postal, teléfono, email, fecha de nacimiento, fotografía de perfil.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg my-4">
                        <h3 class="font-bold text-gray-900 mb-3"><i class="fas fa-globe mr-2 text-indigo-600"></i>Datos de Navegación</h3>
                        <p class="text-sm">Dirección IP, tipo de navegador, sistema operativo, páginas visitadas, cookies, geolocalización aproximada.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg my-4">
                        <h3 class="font-bold text-gray-900 mb-3"><i class="fas fa-credit-card mr-2 text-indigo-600"></i>Datos Comerciales</h3>
                        <p class="text-sm">Historial de pedidos, preferencias de productos, métodos de pago, datos de facturación.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg my-4">
                        <h3 class="font-bold text-gray-900 mb-3"><i class="fas fa-paw mr-2 text-indigo-600"></i>Datos de Mascotas</h3>
                        <p class="text-sm">Nombre, especie, raza, edad, historial médico, vacunaciones, tratamientos, alergias, fotografías.</p>
                    </div>
                </div>
            </section>

            <!-- Sección 5: Plazo de Conservación -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-clock mr-3"></i>
                    5. Plazo de Conservación de los Datos
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden my-4">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Tipo de Datos</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Plazo de Conservación</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm">Usuarios registrados</td>
                                <td class="px-6 py-4 text-sm">Mientras la cuenta esté activa + plazos legales</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 text-sm">Pedidos y facturación</td>
                                <td class="px-6 py-4 text-sm">6 años desde la última compra</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm">Historial médico veterinario</td>
                                <td class="px-6 py-4 text-sm">Mínimo 5 años desde última asistencia</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 text-sm">Comunicaciones comerciales</td>
                                <td class="px-6 py-4 text-sm">Hasta revocación del consentimiento</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm">Cookies y navegación</td>
                                <td class="px-6 py-4 text-sm">Entre 1 mes y 2 años según tipo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Sección 6: Destinatarios -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-share-alt mr-3"></i>
                    6. Destinatarios y Cesiones de Datos
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p>Los datos personales podrán ser comunicados a las siguientes categorías de destinatarios:</p>
                    <ul class="space-y-2 my-4">
                        <li><i class="fas fa-server text-blue-500 mr-2"></i><strong>Servicios de hosting:</strong> Proveedores de alojamiento web en la UE</li>
                        <li><i class="fas fa-credit-card text-green-500 mr-2"></i><strong>Pasarelas de pago:</strong> Stripe, PayPal, Redsys (PCI-DSS)</li>
                        <li><i class="fas fa-envelope text-purple-500 mr-2"></i><strong>Email marketing:</strong> Mailchimp, SendGrid (con consentimiento)</li>
                        <li><i class="fas fa-truck text-yellow-500 mr-2"></i><strong>Servicios de mensajería:</strong> Empresas de transporte para envíos</li>
                        <li><i class="fas fa-chart-bar text-red-500 mr-2"></i><strong>Análisis web:</strong> Google Analytics (con consentimiento)</li>
                        <li><i class="fas fa-landmark text-gray-500 mr-2"></i><strong>Administraciones públicas:</strong> Cuando exista obligación legal</li>
                    </ul>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 my-6 rounded-r-lg">
                        <p class="text-sm"><i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i><strong>Transferencias internacionales:</strong> Algunos proveedores pueden estar fuera del EEE. En estos casos, se garantizan las salvaguardas adecuadas previstas en el RGPD (cláusulas contractuales tipo, certificaciones reconocidas).</p>
                    </div>
                </div>
            </section>

            <!-- Sección 7: Derechos ARSOLP+ -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-user-shield mr-3"></i>
                    7. Derechos de los Interesados (ARSOLP+)
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p class="mb-4">El usuario tiene derecho a ejercer los siguientes derechos reconocidos en el RGPD:</p>
                    
                    <div class="grid md:grid-cols-2 gap-4 my-6">
                        <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-blue-900 mb-2"><i class="fas fa-eye mr-2"></i>Acceso</h3>
                            <p class="text-sm text-gray-700">Obtener confirmación sobre si se tratan sus datos y acceder a ellos.</p>
                        </div>
                        <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-green-900 mb-2"><i class="fas fa-edit mr-2"></i>Rectificación</h3>
                            <p class="text-sm text-gray-700">Corregir datos inexactos o completar datos incompletos.</p>
                        </div>
                        <div class="border-l-4 border-red-500 bg-red-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-red-900 mb-2"><i class="fas fa-trash mr-2"></i>Supresión</h3>
                            <p class="text-sm text-gray-700">Solicitar la eliminación de sus datos ("derecho al olvido").</p>
                        </div>
                        <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-yellow-900 mb-2"><i class="fas fa-ban mr-2"></i>Oposición</h3>
                            <p class="text-sm text-gray-700">Oponerse al tratamiento de sus datos en determinadas circunstancias.</p>
                        </div>
                        <div class="border-l-4 border-purple-500 bg-purple-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-purple-900 mb-2"><i class="fas fa-pause mr-2"></i>Limitación</h3>
                            <p class="text-sm text-gray-700">Solicitar la limitación del tratamiento de sus datos.</p>
                        </div>
                        <div class="border-l-4 border-indigo-500 bg-indigo-50 p-4 rounded-r-lg">
                            <h3 class="font-bold text-indigo-900 mb-2"><i class="fas fa-exchange-alt mr-2"></i>Portabilidad</h3>
                            <p class="text-sm text-gray-700">Recibir sus datos en formato estructurado y transmitirlos a otro responsable.</p>
                        </div>
                    </div>

                    <div class="bg-indigo-100 border border-indigo-300 p-6 rounded-lg my-6">
                        <h3 class="font-bold text-indigo-900 mb-3"><i class="fas fa-paper-plane mr-2"></i>Cómo ejercer sus derechos</h3>
                        <p class="text-sm mb-3">Para ejercer cualquiera de estos derechos, envíe una comunicación a:</p>
                        <ul class="text-sm space-y-2">
                            <li><i class="fas fa-envelope mr-2 text-indigo-600"></i><strong>Email:</strong> <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a> (asunto: "Ejercicio de Derechos RGPD")</li>
                            <li><i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i><strong>Correo postal:</strong> Calle Veterinaria, 123 - 28001 Madrid, España</li>
                            <li><i class="fas fa-user-shield mr-2 text-indigo-600"></i><strong>Delegado de Protección de Datos:</strong> <a href="mailto:dpo@maskotas.com" class="text-indigo-600 hover:underline">dpo@maskotas.com</a></li>
                        </ul>
                        <p class="text-sm mt-3 text-gray-700">Incluya: nombre completo, DNI, especificación del derecho a ejercer, domicilio y firma.</p>
                        <p class="text-sm mt-2 font-semibold text-indigo-900">Plazo de respuesta: máximo 1 mes (prorrogable 2 meses más en casos complejos).</p>
                    </div>

                    <div class="bg-red-50 border-l-4 border-red-500 p-4 my-6 rounded-r-lg">
                        <h3 class="font-bold text-red-900 mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Derecho a reclamación</h3>
                        <p class="text-sm text-gray-700">Puede presentar una reclamación ante la <strong>Agencia Española de Protección de Datos (AEPD)</strong>:</p>
                        <p class="text-sm mt-2">C/ Jorge Juan, 6 - 28001 Madrid</p>
                        <p class="text-sm">Tel: 901 100 099 / 912 663 517</p>
                        <p class="text-sm">Web: <a href="https://www.aepd.es" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline">www.aepd.es</a></p>
                    </div>
                </div>
            </section>

            <!-- Sección 8: Medidas de Seguridad -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-lock mr-3"></i>
                    8. Medidas de Seguridad
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p class="mb-6">MASK!OTAS ha implementado un marco integral de seguridad de la información basado en las mejores prácticas internacionales (ISO/IEC 27001, NIST Cybersecurity Framework) y los requisitos específicos del RGPD. A continuación se detallan las medidas técnicas y organizativas adoptadas:</p>

                    <!-- Medidas Técnicas -->
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-xl my-6 border-2 border-indigo-200">
                        <h3 class="text-xl font-bold text-indigo-900 mb-4 flex items-center">
                            <i class="fas fa-microchip mr-3 text-indigo-600"></i>
                            8.1. Medidas Técnicas de Seguridad
                        </h3>

                        <!-- Cifrado y Criptografía -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                                A) Cifrado y Protección Criptográfica
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Cifrado en tránsito (TLS 1.3):</strong> Implementación de certificados SSL/TLS con protocolo TLS 1.3, utilizando suites de cifrado robustas (AES-256-GCM, ChaCha20-Poly1305). Configuración HSTS (HTTP Strict Transport Security) con preload para forzar conexiones HTTPS.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Cifrado en reposo:</strong> Contraseñas almacenadas mediante algoritmo bcrypt con factor de coste 12 (4096 iteraciones). Datos sensibles en base de datos cifrados con AES-256 en modo CBC. Claves de cifrado gestionadas mediante sistema de gestión de claves (KMS) con rotación automática trimestral.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Perfect Forward Secrecy (PFS):</strong> Implementación de intercambio de claves Diffie-Hellman efímero (ECDHE) para garantizar que el compromiso de claves privadas no afecte a sesiones pasadas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Certificados digitales:</strong> Certificados SSL/TLS emitidos por autoridades certificadoras reconocidas (Let's Encrypt, DigiCert) con renovación automática cada 90 días. Implementación de Certificate Transparency para detección de certificados fraudulentos.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Control de Acceso -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-user-lock text-blue-600 mr-2"></i>
                                B) Control de Acceso y Autenticación
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Autenticación multifactor (MFA/2FA):</strong> Autenticación de dos factores obligatoria para cuentas administrativas mediante TOTP (Time-based One-Time Password) compatible con Google Authenticator, Authy y Microsoft Authenticator. Opcional para usuarios finales.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Control de acceso basado en roles (RBAC):</strong> Sistema de permisos granular con roles predefinidos (Administrador, Veterinario, Usuario, Invitado). Principio de mínimo privilegio aplicado a todos los niveles. Segregación de funciones críticas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Políticas de contraseñas robustas:</strong> Longitud mínima de 10 caracteres, combinación obligatoria de mayúsculas, minúsculas, números y símbolos. Verificación contra base de datos de contraseñas comprometidas (Have I Been Pwned API). Expiración de contraseñas cada 180 días para cuentas privilegiadas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Gestión de sesiones seguras:</strong> Tokens de sesión generados con CSPRNG (Cryptographically Secure Pseudo-Random Number Generator). Timeout de sesión tras 30 minutos de inactividad. Invalidación de sesiones antiguas al cambiar contraseña. Protección contra session fixation y session hijacking.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Protección contra fuerza bruta:</strong> Limitación de intentos de login (5 intentos en 15 minutos). Bloqueo temporal de cuenta tras intentos fallidos. CAPTCHA tras 3 intentos fallidos. Rate limiting en endpoints de autenticación (10 req/min por IP).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Gestión de accesos privilegiados (PAM):</strong> Acceso a servidores mediante SSH con autenticación por clave pública (RSA 4096 bits). Deshabilitación de autenticación por contraseña en SSH. Uso de bastion hosts para acceso a infraestructura crítica.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Seguridad de Aplicaciones -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-code text-purple-600 mr-2"></i>
                                C) Seguridad de Aplicaciones Web
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Web Application Firewall (WAF):</strong> Cloudflare WAF con reglas OWASP ModSecurity Core Rule Set (CRS). Protección contra OWASP Top 10: SQL Injection, XSS, CSRF, XXE, SSRF, Path Traversal, Remote Code Execution. Filtrado de tráfico malicioso basado en geolocalización y reputación de IPs.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Validación y sanitización de entradas:</strong> Validación estricta de todos los inputs del usuario (whitelist approach). Sanitización de datos mediante funciones específicas de Laravel (htmlspecialchars, strip_tags). Uso de prepared statements y ORM (Eloquent) para prevenir SQL Injection.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Protección CSRF:</strong> Tokens CSRF únicos por sesión en todos los formularios. Verificación automática mediante middleware de Laravel. Regeneración de tokens tras autenticación exitosa.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Content Security Policy (CSP):</strong> Política CSP restrictiva para prevenir XSS. Directivas: default-src 'self', script-src 'self' 'nonce-{random}', style-src 'self' 'unsafe-inline', img-src 'self' data: https:. Reportes de violaciones CSP enviados a endpoint de monitorización.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Cabeceras de seguridad HTTP:</strong> X-Frame-Options: DENY (prevención de clickjacking), X-Content-Type-Options: nosniff, X-XSS-Protection: 1; mode=block, Referrer-Policy: strict-origin-when-cross-origin, Permissions-Policy para control de APIs del navegador.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Gestión de dependencias:</strong> Análisis automático de vulnerabilidades en dependencias mediante Composer Audit y npm audit. Actualización regular de frameworks y librerías. Suscripción a alertas de seguridad (CVE, GitHub Security Advisories).</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Infraestructura y Red -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-network-wired text-red-600 mr-2"></i>
                                D) Seguridad de Infraestructura y Red
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Segmentación de red:</strong> Arquitectura de red segmentada en VLANs (DMZ, zona de aplicaciones, zona de datos). Aislamiento de base de datos en red privada sin acceso directo desde Internet. Comunicación entre segmentos mediante firewalls de capa 7.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Firewalls y filtrado:</strong> Firewall perimetral con reglas de deny-by-default. Firewall de aplicación (iptables/nftables) en cada servidor. Filtrado de puertos: solo 80/443 (HTTP/HTTPS) y 22 (SSH con IP whitelisting) abiertos externamente.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Protección DDoS:</strong> Cloudflare DDoS Protection con mitigación automática de ataques volumétricos (L3/L4) y de aplicación (L7). Capacidad de absorción de ataques de hasta 100 Gbps. Rate limiting adaptativo basado en patrones de tráfico.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>IDS/IPS:</strong> Sistema de detección y prevención de intrusiones (Snort/Suricata) con reglas actualizadas diariamente. Detección de anomalías basada en machine learning. Bloqueo automático de IPs maliciosas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Hardening de servidores:</strong> Configuración mínima de servicios (principio de superficie de ataque mínima). Deshabilitación de servicios innecesarios. Actualizaciones automáticas de seguridad del sistema operativo (Ubuntu LTS). Configuración según CIS Benchmarks.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Copias de Seguridad -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-database text-yellow-600 mr-2"></i>
                                E) Copias de Seguridad y Recuperación
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Estrategia de backup 3-2-1:</strong> 3 copias de datos, en 2 medios diferentes, con 1 copia offsite. Backups completos semanales + incrementales diarios. Retención: 30 días diarios, 12 meses mensuales, 7 años anuales (datos críticos).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Cifrado de backups:</strong> Todas las copias cifradas con AES-256 antes de almacenamiento. Claves de cifrado almacenadas en HSM (Hardware Security Module) o KMS separado. Verificación de integridad mediante checksums SHA-256.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Almacenamiento geográficamente distribuido:</strong> Backup primario en datacenter principal (Madrid). Backup secundario en datacenter de respaldo (Barcelona). Backup terciario en cloud storage (AWS S3 con versionado habilitado).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Pruebas de recuperación:</strong> Simulacros de recuperación ante desastres trimestrales. Verificación de integridad de backups mensual. RTO (Recovery Time Objective): 4 horas. RPO (Recovery Point Objective): 24 horas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Protección contra ransomware:</strong> Backups inmutables (write-once-read-many). Air-gap lógico mediante políticas de retención. Snapshots de base de datos cada 6 horas con retención de 7 días.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Monitorización y Logging -->
                        <div class="bg-white p-5 rounded-lg shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-chart-line text-indigo-600 mr-2"></i>
                                F) Monitorización, Logging y Respuesta a Incidentes
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>SIEM (Security Information and Event Management):</strong> Centralización de logs en sistema SIEM (Elastic Stack / Splunk). Correlación de eventos de seguridad en tiempo real. Alertas automáticas ante patrones sospechosos.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>Registro exhaustivo de eventos:</strong> Logs de autenticación (login exitoso/fallido, cambios de contraseña). Logs de acceso a datos sensibles (consulta de historiales médicos, datos personales). Logs de cambios administrativos. Retención de logs: 2 años en almacenamiento activo, 5 años en archivo.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>Monitorización 24/7:</strong> Supervisión continua de infraestructura mediante Prometheus + Grafana. Alertas en tiempo real vía PagerDuty/Opsgenie. Métricas monitorizadas: CPU, memoria, disco, red, latencia, tasa de errores, disponibilidad.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>Análisis de comportamiento:</strong> Detección de anomalías mediante machine learning (accesos inusuales, patrones de tráfico anómalos). Alertas de actividad sospechosa: accesos desde ubicaciones geográficas inusuales, múltiples descargas masivas de datos, cambios de configuración no autorizados.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>Plan de respuesta a incidentes:</strong> Equipo CSIRT (Computer Security Incident Response Team) designado. Procedimientos documentados para clasificación, contención, erradicación y recuperación. Tiempos de respuesta: Crítico (15 min), Alto (1 hora), Medio (4 horas), Bajo (24 horas).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2 mt-1"></i>
                                    <span><strong>Threat Intelligence:</strong> Suscripción a feeds de inteligencia de amenazas (MISP, AlienVault OTX). Integración con bases de datos de IOCs (Indicators of Compromise). Actualización automática de reglas de firewall/IDS basadas en nuevas amenazas.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Medidas Organizativas -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-xl my-6 border-2 border-blue-200">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                            <i class="fas fa-users-cog mr-3 text-blue-600"></i>
                            8.2. Medidas Organizativas y de Gobernanza
                        </h3>

                        <!-- Políticas y Procedimientos -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-file-contract text-blue-600 mr-2"></i>
                                A) Políticas y Procedimientos Documentados
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Política de Seguridad de la Información (PSI):</strong> Documento maestro aprobado por la Dirección, revisado anualmente. Alcance: toda la organización y sistemas de información. Basada en ISO/IEC 27001:2022.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Política de Protección de Datos:</strong> Procedimientos específicos para cumplimiento RGPD. Incluye: minimización de datos, limitación de finalidad, exactitud, limitación de plazo, integridad y confidencialidad.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Procedimientos operativos:</strong> Gestión de altas/bajas de usuarios, gestión de incidentes de seguridad, gestión de cambios, gestión de vulnerabilidades, respuesta ante brechas de datos, ejercicio de derechos ARSOLP+.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 mt-1"></i>
                                    <span><strong>Privacy by Design y by Default:</strong> Evaluaciones de impacto (EIPD) obligatorias para nuevos tratamientos de alto riesgo. Configuraciones de privacidad por defecto más restrictivas. Minimización de datos en fase de diseño.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Formación y Concienciación -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                                B) Formación y Concienciación del Personal
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Programa de formación continua:</strong> Formación inicial obligatoria en protección de datos y seguridad para todo el personal (8 horas). Formación de reciclaje anual (4 horas). Formación especializada para roles críticos (administradores, DPO, desarrolladores).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Campañas de concienciación:</strong> Simulacros de phishing trimestrales con feedback formativo. Newsletters mensuales sobre amenazas actuales. Carteles y recordatorios sobre buenas prácticas.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                    <span><strong>Certificaciones del personal:</strong> Certificación CIPP/E (Certified Information Privacy Professional/Europe) para el DPO. Certificaciones de seguridad (CISSP, CEH, OSCP) para el equipo de seguridad.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Gestión de Terceros -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-handshake text-purple-600 mr-2"></i>
                                C) Gestión de Proveedores y Encargados del Tratamiento
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Due diligence de proveedores:</strong> Evaluación de seguridad y privacidad antes de contratación. Cuestionarios de seguridad (SIG, CAIQ). Revisión de certificaciones (ISO 27001, SOC 2, PCI-DSS).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Contratos de encargado del tratamiento:</strong> Cláusulas contractuales conforme Art. 28 RGPD. Obligaciones de confidencialidad, seguridad, notificación de brechas, subcontratación autorizada, auditorías, eliminación de datos al finalizar el servicio.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-purple-500 mr-2 mt-1"></i>
                                    <span><strong>Auditorías a proveedores:</strong> Auditorías anuales a proveedores críticos. Revisión de informes SOC 2 Type II. Derecho de auditoría reservado contractualmente.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Control de Acceso Organizativo -->
                        <div class="bg-white p-5 rounded-lg mb-4 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-user-shield text-red-600 mr-2"></i>
                                D) Control de Acceso y Segregación de Funciones
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Proceso de alta/baja de usuarios:</strong> Solicitud formal de acceso aprobada por responsable de área. Provisión de accesos basada en necesidad de conocer (need-to-know). Revocación inmediata de accesos al finalizar relación laboral (checklist de offboarding).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Revisión periódica de accesos:</strong> Recertificación trimestral de permisos por responsables de área. Eliminación automática de cuentas inactivas tras 90 días. Auditoría semestral de privilegios administrativos.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1"></i>
                                    <span><strong>Segregación de funciones:</strong> Separación de roles críticos (desarrollo, operaciones, seguridad). Aprobación dual para operaciones críticas (eliminación de backups, cambios en producción). Rotación de funciones sensibles.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Auditorías y Cumplimiento -->
                        <div class="bg-white p-5 rounded-lg shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-clipboard-check text-yellow-600 mr-2"></i>
                                E) Auditorías, Evaluaciones y Mejora Continua
                            </h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Auditorías internas:</strong> Auditoría anual de cumplimiento RGPD. Auditoría semestral de seguridad de la información. Auditoría trimestral de controles de acceso.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Auditorías externas:</strong> Auditoría externa anual por firma independiente. Pentesting anual por empresa especializada (OWASP, PTES). Certificación ISO 27001 (en proceso).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Evaluaciones de impacto (EIPD):</strong> EIPD obligatoria para tratamientos de alto riesgo. Metodología basada en guías AEPD y WP29. Consulta previa a AEPD cuando proceda.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Gestión de vulnerabilidades:</strong> Escaneo automático de vulnerabilidades semanal (Nessus, OpenVAS). Programa de Bug Bounty para investigadores de seguridad. SLA de remediación: Críticas (24h), Altas (7 días), Medias (30 días), Bajas (90 días).</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-yellow-500 mr-2 mt-1"></i>
                                    <span><strong>Mejora continua:</strong> Comité de Seguridad y Privacidad trimestral. Revisión de indicadores (KPIs): tiempo de detección de incidentes, tiempo de respuesta, tasa de vulnerabilidades críticas, cumplimiento de SLAs. Implementación de lecciones aprendidas post-incidente.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Notificación de Brechas -->
                    <div class="bg-red-50 border-l-4 border-red-500 p-6 my-6 rounded-r-lg">
                        <h3 class="font-bold text-red-900 mb-3 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            8.3. Protocolo de Notificación de Brechas de Seguridad
                        </h3>
                        <div class="text-sm text-gray-700 space-y-3">
                            <p><strong>Detección y evaluación:</strong> Monitorización continua para detección temprana. Evaluación inmediata del alcance, gravedad y riesgo para los interesados. Clasificación según criterios: número de afectados, tipo de datos, posibles consecuencias.</p>
                            <p><strong>Notificación a la AEPD (Art. 33 RGPD):</strong> Notificación en plazo máximo de <strong>72 horas</strong> desde conocimiento de la brecha. Información incluida: naturaleza de la violación, categorías y número de afectados, contacto del DPO, consecuencias probables, medidas adoptadas y propuestas.</p>
                            <p><strong>Comunicación a los interesados (Art. 34 RGPD):</strong> Notificación <strong>sin dilación indebida</strong> si existe alto riesgo para derechos y libertades. Lenguaje claro y sencillo. Información sobre medidas de protección recomendadas.</p>
                            <p><strong>Registro de brechas:</strong> Documentación de todas las violaciones de seguridad (incluso las no notificables). Registro de hechos, efectos y medidas correctivas. Disponible para inspección por AEPD.</p>
                        </div>
                    </div>

                    <!-- Certificaciones y Estándares -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl my-6 border-2 border-green-200">
                        <h3 class="font-bold text-green-900 mb-3 flex items-center text-lg">
                            <i class="fas fa-certificate mr-2 text-green-600"></i>
                            8.4. Certificaciones y Estándares de Cumplimiento
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 mt-4">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h4 class="font-bold text-gray-900 mb-2 text-sm"><i class="fas fa-shield-alt text-blue-600 mr-2"></i>ISO/IEC 27001:2022</h4>
                                <p class="text-xs text-gray-600">Sistema de Gestión de Seguridad de la Información (en proceso de certificación - auditoría prevista Q3 2026)</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h4 class="font-bold text-gray-900 mb-2 text-sm"><i class="fas fa-check-circle text-green-600 mr-2"></i>RGPD Compliance</h4>
                                <p class="text-xs text-gray-600">Cumplimiento verificado del Reglamento General de Protección de Datos (UE) 2016/679</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h4 class="font-bold text-gray-900 mb-2 text-sm"><i class="fas fa-credit-card text-purple-600 mr-2"></i>PCI-DSS Level 2</h4>
                                <p class="text-xs text-gray-600">Cumplimiento de estándares de seguridad de datos de la industria de tarjetas de pago (mediante proveedores certificados)</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h4 class="font-bold text-gray-900 mb-2 text-sm"><i class="fas fa-globe text-indigo-600 mr-2"></i>ENS (Esquema Nacional de Seguridad)</h4>
                                <p class="text-xs text-gray-600">Alineación con el marco de seguridad español para sistemas de información (categoría MEDIA)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Compromiso de Mejora -->
                    <div class="bg-indigo-600 text-white p-6 rounded-xl text-center">
                        <i class="fas fa-rocket text-4xl mb-3"></i>
                        <h3 class="text-xl font-bold mb-2">Compromiso de Mejora Continua</h3>
                        <p class="text-sm text-indigo-100">MASK!OTAS se compromete a mantener y mejorar continuamente sus medidas de seguridad, adaptándolas a la evolución tecnológica, las amenazas emergentes y las mejores prácticas del sector, garantizando en todo momento un nivel de seguridad adecuado al riesgo y la protección óptima de los datos personales de nuestros usuarios y sus mascotas.</p>
                    </div>
                </div>
            </section>

            <!-- Sección 9: Información Adicional -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    9. Información Adicional
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <h3 class="font-bold text-gray-900 mb-3">Exactitud de los datos</h3>
                    <p class="mb-4">El usuario garantiza que los datos facilitados son veraces, exactos y actualizados, siendo responsable de cualquier daño derivado de su inexactitud.</p>

                    <h3 class="font-bold text-gray-900 mb-3">Menores de edad</h3>
                    <p class="mb-4">Los servicios están dirigidos a mayores de 14 años. Para menores de esta edad, será necesario el consentimiento de los padres o tutores legales.</p>

                    <h3 class="font-bold text-gray-900 mb-3">Cookies</h3>
                    <p class="mb-4">Este sitio utiliza cookies. Para más información, consulte nuestra <a href="#" class="text-indigo-600 hover:underline font-semibold">Política de Cookies</a>.</p>

                    <h3 class="font-bold text-gray-900 mb-3">Modificaciones</h3>
                    <p class="mb-4">MASK!OTAS se reserva el derecho a modificar esta política para adaptarla a novedades legislativas. Las modificaciones sustanciales serán comunicadas a los usuarios.</p>
                </div>
            </section>

            <!-- Sección 10: Legislación y Contacto -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-indigo-600 mb-4 flex items-center">
                    <i class="fas fa-balance-scale mr-3"></i>
                    10. Legislación Aplicable
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p>Esta Política de Privacidad se rige por la legislación española vigente:</p>
                    <ul class="space-y-2 my-4">
                        <li><i class="fas fa-check text-indigo-600 mr-2"></i>Reglamento (UE) 2016/679 (RGPD)</li>
                        <li><i class="fas fa-check text-indigo-600 mr-2"></i>Ley Orgánica 3/2018 (LOPDGDD)</li>
                        <li><i class="fas fa-check text-indigo-600 mr-2"></i>Ley 34/2002 (LSSI-CE)</li>
                    </ul>
                </div>
            </section>

            <!-- Contacto Final -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8 rounded-xl text-center mt-12">
                <h3 class="text-2xl font-bold mb-4">
                    <i class="fas fa-envelope-open-text mr-2"></i>
                    ¿Tienes alguna consulta?
                </h3>
                <p class="mb-6">Para cualquier duda sobre protección de datos, contáctanos:</p>
                <div class="space-y-2">
                    <p><i class="fas fa-envelope mr-2"></i><a href="mailto:info@maskotas.com" class="underline hover:text-indigo-200">info@maskotas.com</a></p>
                    <p><i class="fas fa-phone mr-2"></i>+34 911 234 567</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>Calle Veterinaria, 123 - 28001 Madrid</p>
                </div>
                <p class="mt-6 text-sm text-indigo-200">Comprometidos con la protección de su privacidad y la de sus mascotas.</p>
            </div>
        </div>

        <!-- Botón Volver -->
        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-full font-bold shadow-lg transform hover:scale-105 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection
