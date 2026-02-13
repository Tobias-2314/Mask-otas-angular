@extends('layouts.app')

@section('titulo', 'Términos de Servicio - MASK!OTAS')

@section('contenido')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-4 rounded-xl">
                    <i class="fas fa-file-contract text-white text-4xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Términos de Servicio</h1>
                    <p class="text-gray-600 mt-2">Última actualización: {{ date('d/m/Y') }}</p>
                </div>
            </div>
            <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-lg">
                <p class="text-gray-700 leading-relaxed">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i>
                    Estos Términos de Servicio regulan el uso del sitio web y los servicios ofrecidos por <strong>MASK!OTAS</strong>. 
                    Al acceder y utilizar nuestros servicios, aceptas estos términos en su totalidad.
                </p>
            </div>
        </div>

        <!-- Contenido -->
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            
            <!-- 1. Identificación -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-building text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">1. Identificación del Prestador de Servicios</h2>
                </div>
                <div class="bg-gray-50 p-5 rounded-lg space-y-2">
                    <p class="text-gray-700"><strong>Denominación Social:</strong> MASK!OTAS - Servicios Veterinarios S.L.</p>
                    <p class="text-gray-700"><strong>CIF:</strong> B-87654321</p>
                    <p class="text-gray-700"><strong>Domicilio Social:</strong> Calle Veterinaria, 123, 28001 Madrid, España</p>
                    <p class="text-gray-700"><strong>Correo Electrónico:</strong> <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a></p>
                    <p class="text-gray-700"><strong>Teléfono:</strong> <a href="tel:+34911234567" class="text-indigo-600 hover:underline">+34 911 234 567</a></p>
                    <p class="text-gray-700"><strong>Registro Mercantil:</strong> Madrid, Tomo 12345, Folio 67, Hoja M-234567</p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 2. Objeto y Ámbito -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-bullseye text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">2. Objeto y Ámbito de Aplicación</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-3">
                    <p>
                        Los presentes Términos de Servicio regulan el acceso y uso del sitio web <strong>www.maskotas.com</strong> 
                        (en adelante, el "Sitio Web") y los servicios ofrecidos a través del mismo, incluyendo:
                    </p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li><strong>Servicios Veterinarios:</strong> Consultas, vacunación, cirugía, urgencias 24/7</li>
                        <li><strong>Tienda Online:</strong> Venta de productos para mascotas (alimentos, accesorios, medicamentos)</li>
                        <li><strong>Sistema de Citas:</strong> Reserva online de citas veterinarias</li>
                        <li><strong>Área de Usuario:</strong> Gestión de perfil, historial médico de mascotas, pedidos</li>
                        <li><strong>Contenidos Informativos:</strong> Blog, guías de cuidado animal, consejos veterinarios</li>
                    </ul>
                    <p class="mt-4">
                        El acceso y uso del Sitio Web implica la aceptación plena y sin reservas de estos Términos de Servicio. 
                        Si no estás de acuerdo con alguna de las condiciones, deberás abstenerte de utilizar el Sitio Web.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 3. Condiciones de Acceso -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-user-check text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">3. Condiciones de Acceso y Uso</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">3.1. Requisitos de Edad</h3>
                    <p>
                        Para utilizar nuestros servicios, debes ser mayor de 18 años o contar con la autorización de tus padres o tutores legales. 
                        Al registrarte, declaras que cumples con este requisito.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">3.2. Registro de Usuario</h3>
                    <p>
                        Para acceder a determinados servicios (citas, compras, historial médico), es necesario crear una cuenta de usuario. 
                        Te comprometes a:
                    </p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Proporcionar información veraz, exacta y actualizada</li>
                        <li>Mantener la confidencialidad de tus credenciales de acceso</li>
                        <li>Notificar inmediatamente cualquier uso no autorizado de tu cuenta</li>
                        <li>Ser responsable de todas las actividades realizadas bajo tu cuenta</li>
                    </ul>

                    <h3 class="text-lg font-bold text-gray-900">3.3. Uso Adecuado</h3>
                    <p>Te comprometes a utilizar el Sitio Web de forma lícita y conforme a estos Términos. Queda expresamente prohibido:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Realizar actividades ilícitas, fraudulentas o que infrinjan derechos de terceros</li>
                        <li>Transmitir virus, malware o cualquier código malicioso</li>
                        <li>Intentar acceder a áreas restringidas del sistema</li>
                        <li>Realizar ingeniería inversa, descompilar o desensamblar el software</li>
                        <li>Utilizar robots, scrapers o sistemas automatizados sin autorización</li>
                        <li>Realizar spam, phishing o cualquier forma de comunicación no solicitada</li>
                        <li>Suplantar la identidad de otra persona o entidad</li>
                    </ul>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 4. Servicios Veterinarios -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-stethoscope text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">4. Servicios Veterinarios</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">4.1. Citas y Consultas</h3>
                    <p>
                        Las citas pueden reservarse a través del sistema online o por teléfono. Nos reservamos el derecho de confirmar, 
                        modificar o cancelar citas por razones operativas o de emergencia, notificándote con la mayor antelación posible.
                    </p>
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                        <p class="text-sm">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                            <strong>Política de Cancelación:</strong> Las cancelaciones deben realizarse con al menos 24 horas de antelación. 
                            Las cancelaciones tardías o ausencias sin previo aviso pueden estar sujetas a un cargo del 50% del servicio.
                        </p>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">4.2. Limitación de Responsabilidad Médica</h3>
                    <p>
                        Nuestros servicios veterinarios se prestan con la máxima diligencia profesional y conforme a las mejores prácticas veterinarias. 
                        Sin embargo, la medicina veterinaria no es una ciencia exacta y los resultados pueden variar según cada caso.
                    </p>
                    <p>
                        <strong>MASK!OTAS</strong> no garantiza resultados específicos en tratamientos médicos. Nuestra responsabilidad se limita 
                        a actuar con la diligencia debida conforme a la <em>lex artis</em> veterinaria.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">4.3. Consentimiento Informado</h3>
                    <p>
                        Para procedimientos quirúrgicos, tratamientos invasivos o de riesgo, se requerirá tu consentimiento informado por escrito, 
                        tras explicarte los riesgos, beneficios y alternativas del procedimiento.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 5. Tienda Online -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-shopping-cart text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">5. Tienda Online y Compras</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">5.1. Proceso de Compra</h3>
                    <p>
                        Al realizar un pedido, recibirás un correo de confirmación con los detalles de tu compra. 
                        El contrato de compraventa se perfecciona cuando aceptamos tu pedido mediante el envío de la confirmación.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">5.2. Precios y Disponibilidad</h3>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Los precios incluyen IVA (21% salvo productos con tipo reducido)</li>
                        <li>Los gastos de envío se calculan según destino y peso</li>
                        <li>Nos reservamos el derecho de modificar precios sin previo aviso</li>
                        <li>La disponibilidad de productos está sujeta a stock</li>
                    </ul>

                    <h3 class="text-lg font-bold text-gray-900">5.3. Métodos de Pago</h3>
                    <p>Aceptamos los siguientes métodos de pago:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li><strong>Tarjeta de crédito/débito:</strong> Visa, Mastercard, American Express</li>
                        <li><strong>PayPal:</strong> Pago seguro a través de PayPal</li>
                        <li><strong>Transferencia bancaria:</strong> Para pedidos superiores a 100€</li>
                        <li><strong>Bizum:</strong> Pago instantáneo móvil</li>
                    </ul>

                    <h3 class="text-lg font-bold text-gray-900">5.4. Envío y Entrega</h3>
                    <p>
                        Los plazos de entrega son estimados (3-5 días laborables en península, 5-7 días en Baleares/Canarias). 
                        No nos hacemos responsables de retrasos causados por la empresa de transporte o causas de fuerza mayor.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">5.5. Derecho de Desistimiento (Ley 3/2014)</h3>
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <p class="mb-2">
                            <strong>Dispones de 14 días naturales</strong> desde la recepción del producto para ejercer tu derecho de desistimiento 
                            sin necesidad de justificación, conforme a la Ley de Consumidores y Usuarios.
                        </p>
                        <p class="text-sm mt-3"><strong>Excepciones al derecho de desistimiento:</strong></p>
                        <ul class="list-disc list-inside space-y-1 ml-4 text-sm">
                            <li>Productos perecederos (alimentos frescos, medicamentos caducables)</li>
                            <li>Productos precintados que han sido abiertos por razones de higiene</li>
                            <li>Productos personalizados o hechos a medida</li>
                            <li>Servicios veterinarios ya prestados</li>
                        </ul>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">5.6. Garantías</h3>
                    <p>
                        Todos los productos cuentan con la garantía legal de conformidad de 2 años (Real Decreto Legislativo 1/2007). 
                        Los defectos de fabricación serán reparados, sustituidos o reembolsados según corresponda.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 6. Propiedad Intelectual -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-copyright text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">6. Propiedad Intelectual e Industrial</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-3">
                    <p>
                        Todos los contenidos del Sitio Web (textos, imágenes, logotipos, marcas, diseños, software, bases de datos) 
                        son propiedad de <strong>MASK!OTAS</strong> o de terceros que han autorizado su uso, y están protegidos por 
                        las leyes españolas e internacionales de propiedad intelectual e industrial.
                    </p>
                    <p>
                        Queda prohibida la reproducción, distribución, comunicación pública, transformación o cualquier otra forma de explotación 
                        de los contenidos sin autorización expresa por escrito.
                    </p>
                    <p>
                        El uso del Sitio Web no te otorga ningún derecho de propiedad sobre los contenidos, únicamente una licencia limitada, 
                        no exclusiva, no transferible y revocable para uso personal y no comercial.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 7. Protección de Datos -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-shield-alt text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">7. Protección de Datos Personales</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        El tratamiento de tus datos personales se rige por nuestra 
                        <a href="{{ route('politica-privacidad') }}" class="text-indigo-600 hover:underline font-semibold">Política de Privacidad</a>, 
                        conforme al Reglamento (UE) 2016/679 (RGPD) y la Ley Orgánica 3/2018 de Protección de Datos (LOPDGDD).
                    </p>
                    <p class="mt-3">
                        Al utilizar nuestros servicios, consientes el tratamiento de tus datos según lo establecido en la Política de Privacidad.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 8. Cookies -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-cookie-bite text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">8. Política de Cookies</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Este Sitio Web utiliza cookies propias y de terceros para mejorar la experiencia de navegación y ofrecer servicios personalizados. 
                        Consulta nuestra <a href="{{ route('politica-cookies') }}" class="text-indigo-600 hover:underline font-semibold">Política de Cookies</a> 
                        para más información sobre qué cookies utilizamos y cómo gestionarlas.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 9. Responsabilidad -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-exclamation-circle text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">9. Limitación de Responsabilidad</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">9.1. Disponibilidad del Servicio</h3>
                    <p>
                        No garantizamos la disponibilidad y continuidad ininterrumpida del Sitio Web. Nos reservamos el derecho de suspender, 
                        interrumpir o modificar el servicio por mantenimiento, actualizaciones o causas técnicas, sin previo aviso.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">9.2. Contenidos de Terceros</h3>
                    <p>
                        El Sitio Web puede contener enlaces a sitios web de terceros. No nos hacemos responsables del contenido, 
                        políticas de privacidad o prácticas de estos sitios externos.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">9.3. Exclusión de Garantías</h3>
                    <p>
                        Salvo disposición legal en contrario, no ofrecemos garantías sobre la exactitud, actualidad o completitud de los contenidos informativos. 
                        Los contenidos del blog y guías son meramente informativos y no sustituyen el consejo veterinario profesional.
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">9.4. Virus y Seguridad</h3>
                    <p>
                        Aunque implementamos medidas de seguridad, no podemos garantizar la ausencia total de virus o elementos maliciosos. 
                        Es responsabilidad del usuario disponer de herramientas de protección adecuadas.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 10. Resolución de Conflictos -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-balance-scale text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">10. Resolución de Conflictos y Reclamaciones</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">10.1. Atención al Cliente</h3>
                    <p>
                        Para cualquier reclamación o consulta, puedes contactarnos en:
                    </p>
                    <ul class="list-disc list-inside space-y-1 ml-4">
                        <li>Email: <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a></li>
                        <li>Teléfono: <a href="tel:+34911234567" class="text-indigo-600 hover:underline">+34 911 234 567</a></li>
                        <li>Dirección postal: Calle Veterinaria, 123, 28001 Madrid</li>
                    </ul>

                    <h3 class="text-lg font-bold text-gray-900">10.2. Resolución Alternativa de Litigios (RAL)</h3>
                    <p>
                        Conforme al Reglamento (UE) 524/2013, los consumidores pueden acceder a la plataforma europea de resolución de litigios en línea:
                    </p>
                    <p class="ml-4">
                        <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-semibold">
                            https://ec.europa.eu/consumers/odr
                        </a>
                    </p>

                    <h3 class="text-lg font-bold text-gray-900">10.3. Hojas de Reclamaciones</h3>
                    <p>
                        Disponemos de hojas de reclamaciones oficiales a disposición de los consumidores en nuestras instalaciones físicas 
                        y en formato electrónico previa solicitud.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 11. Modificaciones -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-edit text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">11. Modificación de los Términos</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Nos reservamos el derecho de modificar estos Términos de Servicio en cualquier momento. 
                        Las modificaciones entrarán en vigor desde su publicación en el Sitio Web.
                    </p>
                    <p class="mt-3">
                        Es tu responsabilidad revisar periódicamente estos Términos. El uso continuado del Sitio Web tras la publicación 
                        de modificaciones implica la aceptación de las mismas.
                    </p>
                    <p class="mt-3">
                        La fecha de última actualización se indica en la parte superior de este documento.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 12. Legislación y Jurisdicción -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-gavel text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">12. Legislación Aplicable y Jurisdicción</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Estos Términos de Servicio se rigen por la legislación española. En particular, son de aplicación:
                    </p>
                    <ul class="list-disc list-inside space-y-1 ml-4 mt-3">
                        <li>Ley 34/2002, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSI-CE)</li>
                        <li>Real Decreto Legislativo 1/2007, Ley General para la Defensa de los Consumidores y Usuarios</li>
                        <li>Reglamento (UE) 2016/679 de Protección de Datos (RGPD)</li>
                        <li>Ley Orgánica 3/2018 de Protección de Datos (LOPDGDD)</li>
                        <li>Código Civil español</li>
                        <li>Código de Comercio</li>
                    </ul>
                    <p class="mt-4">
                        Para la resolución de cualquier controversia derivada de estos Términos, las partes se someten a los 
                        <strong>Juzgados y Tribunales de Madrid capital</strong>, renunciando expresamente a cualquier otro fuero que pudiera corresponderles.
                    </p>
                    <p class="mt-3 text-sm italic">
                        Sin perjuicio de lo anterior, si eres consumidor, tendrás derecho a acudir a los tribunales de tu domicilio 
                        conforme a la legislación de protección de consumidores.
                    </p>
                </div>
            </section>

            <hr class="border-gray-200">

            <!-- 13. Contacto -->
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                    <h2 class="text-2xl font-bold text-gray-900">13. Contacto</h2>
                </div>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <p>
                        Para cualquier consulta sobre estos Términos de Servicio, puedes contactarnos en:
                    </p>
                    <div class="bg-gray-50 p-5 rounded-lg mt-4 space-y-2">
                        <p><strong>MASK!OTAS - Servicios Veterinarios S.L.</strong></p>
                        <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Calle Veterinaria, 123, 28001 Madrid, España</p>
                        <p><i class="fas fa-envelope text-indigo-600 mr-2"></i>Email: <a href="mailto:info@maskotas.com" class="text-indigo-600 hover:underline">info@maskotas.com</a></p>
                        <p><i class="fas fa-phone text-indigo-600 mr-2"></i>Teléfono: <a href="tel:+34911234567" class="text-indigo-600 hover:underline">+34 911 234 567</a></p>
                        <p><i class="fas fa-clock text-indigo-600 mr-2"></i>Horario de atención: Lunes a Viernes, 9:00 - 20:00h</p>
                    </div>
                </div>
            </section>

        </div>

        <!-- Footer de la página -->
        <div class="mt-8 text-center space-y-3">
            <div class="flex justify-center gap-6">
                <a href="{{ route('politica-privacidad') }}" class="text-indigo-600 hover:underline font-semibold">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Política de Privacidad
                </a>
                <a href="{{ route('politica-cookies') }}" class="text-indigo-600 hover:underline font-semibold">
                    <i class="fas fa-cookie-bite mr-2"></i>
                    Política de Cookies
                </a>
            </div>
            <p class="text-sm text-gray-600">
                Al utilizar nuestros servicios, aceptas estos Términos de Servicio en su totalidad.
            </p>
        </div>
    </div>
</div>
@endsection
