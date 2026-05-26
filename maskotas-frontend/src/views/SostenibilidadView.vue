<template>
  <div class="sost-page">

    <!-- Hero -->
    <section class="sost-hero">
      <div class="sost-hero-bg" aria-hidden="true">
        <div class="sost-orb sost-orb-1"></div>
        <div class="sost-orb sost-orb-2"></div>
      </div>
      <div class="container sost-hero-inner">
        <div class="sost-badge">
          <span>🌱</span>
          Plan de Sostenibilidad 2026
        </div>
        <h1>Maskotas <em>Sostenible</em></h1>
        <p class="sost-hero-desc">
          Nuestro compromiso como clínica veterinaria con el medio ambiente, el bienestar animal,
          la comunidad y la viabilidad económica a largo plazo.
        </p>
        <div class="sost-pillars">
          <div v-for="p in pillars" :key="p.label" class="sost-pillar">
            <span>{{ p.icon }}</span>
            <span>{{ p.label }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Tabs -->
    <div class="sost-tabs-bar">
      <div class="container">
        <nav class="sost-tabs" aria-label="Secciones del plan">
          <button
            v-for="tab in tabs"
            :key="tab.id"
            :class="['sost-tab', { active: activeTab === tab.id }]"
            @click="activeTab = tab.id"
          >
            <span>{{ tab.icon }}</span> {{ tab.label }}
          </button>
        </nav>
      </div>
    </div>

    <div class="container sost-body">

      <!-- ── Ambiental ──────────────────────────────────────────── -->
      <section v-show="activeTab === 'ambiental'" class="sost-section">
        <div class="section-header">
          <h2>Sostenibilidad Ambiental</h2>
          <p>Reducimos el impacto ambiental de nuestra actividad clínica en cada etapa de la atención veterinaria.</p>
        </div>

        <!-- Resumen de impacto -->
        <div class="metrics-row">
          <div v-for="m in metricas" :key="m.label" class="metric-card">
            <div class="metric-icon">{{ m.icon }}</div>
            <div class="metric-value">{{ m.valor }}</div>
            <div class="metric-label">{{ m.label }}</div>
          </div>
        </div>

        <!-- Residuos sanitarios -->
        <div class="card sost-card">
          <h3 class="card-title">Gestión de Residuos Sanitarios</h3>
          <p class="card-intro">
            Las clínicas veterinarias generan residuos de distintas categorías. Seguimos la normativa de
            gestión de residuos sanitarios (RD 1310/2021) con gestores autorizados.
          </p>
          <div class="residuos-grid">
            <div v-for="r in residuos" :key="r.tipo" class="residuo-card">
              <div class="residuo-icon">{{ r.icon }}</div>
              <div class="residuo-body">
                <strong>{{ r.tipo }}</strong>
                <span class="residuo-ejemplos">{{ r.ejemplos }}</span>
                <span :class="['residuo-gestion', r.nivel]">{{ r.gestion }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Eficiencia energética -->
        <div class="card sost-card">
          <h3 class="card-title">Eficiencia Energética y Recursos</h3>
          <div class="energia-list">
            <div v-for="e in energiaItems" :key="e.accion" class="energia-item">
              <div class="energia-dot" :style="{ background: e.color }"></div>
              <div class="energia-body">
                <div class="energia-head">
                  <strong>{{ e.accion }}</strong>
                  <span class="energia-ahorro">{{ e.ahorro }}</span>
                </div>
                <p>{{ e.desc }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Digitalización -->
        <div class="card sost-card highlight-green">
          <h3 class="card-title">Digitalización como Herramienta Ambiental</h3>
          <p class="card-intro">
            Nuestra plataforma online contribuye directamente a reducir el impacto ambiental de la clínica
            al eliminar procesos en papel y desplazamientos innecesarios.
          </p>
          <div class="digital-grid">
            <div v-for="d in digitalizacion" :key="d.proceso" class="digital-item">
              <span class="digital-antes">Antes: {{ d.antes }}</span>
              <span class="digital-arrow">→</span>
              <span class="digital-despues">Ahora: {{ d.despues }}</span>
              <span class="digital-impacto">{{ d.impacto }}</span>
            </div>
          </div>
        </div>

        <!-- Proveedores -->
        <div class="card sost-card">
          <h3 class="card-title">Criterios de Selección de Proveedores</h3>
          <div class="proveedores-list">
            <div v-for="c in criteriosProveedores" :key="c.criterio" class="proveedor-item">
              <span class="check-verde">✓</span>
              <div>
                <strong>{{ c.criterio }}</strong>
                <p>{{ c.desc }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── Social ─────────────────────────────────────────────── -->
      <section v-show="activeTab === 'social'" class="sost-section">
        <div class="section-header">
          <h2>Sostenibilidad Social</h2>
          <p>El bienestar de los animales, sus familias, nuestro equipo y la comunidad está en el centro de todo lo que hacemos.</p>
        </div>

        <!-- Bienestar animal -->
        <div class="card sost-card">
          <h3 class="card-title">Bienestar Animal — Protocolo Fear Free</h3>
          <p class="card-intro">
            Aplicamos principios del método <em>Fear Free</em> para minimizar el estrés en cada visita,
            mejorando el bienestar del paciente y la calidad del diagnóstico.
          </p>
          <div class="fearfree-grid">
            <div v-for="f in fearFree" :key="f.area" class="fearfree-item">
              <div class="fearfree-icon">{{ f.icon }}</div>
              <div>
                <strong>{{ f.area }}</strong>
                <p>{{ f.desc }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Comunidad -->
        <div class="card sost-card">
          <h3 class="card-title">Impacto en la Comunidad</h3>
          <div class="comunidad-list">
            <div v-for="c in comunidad" :key="c.iniciativa" class="comunidad-item">
              <div class="comunidad-icon">{{ c.icon }}</div>
              <div class="comunidad-body">
                <strong>{{ c.iniciativa }}</strong>
                <p>{{ c.desc }}</p>
                <span class="comunidad-freq">{{ c.frecuencia }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Equipo -->
        <div class="card sost-card">
          <h3 class="card-title">Bienestar y Desarrollo del Equipo</h3>
          <div class="equipo-grid">
            <div v-for="e in equipo" :key="e.area" class="equipo-item">
              <span class="equipo-icon">{{ e.icon }}</span>
              <div>
                <strong>{{ e.area }}</strong>
                <p>{{ e.desc }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Accesibilidad económica -->
        <div class="card sost-card highlight-blue">
          <h3 class="card-title">Accesibilidad Económica a la Atención Veterinaria</h3>
          <p class="card-intro">
            Creemos que todos los animales merecen atención veterinaria de calidad. Por eso ofrecemos
            opciones adaptadas a distintas situaciones económicas.
          </p>
          <div class="acceso-grid">
            <div v-for="a in accesibilidad" :key="a.programa" class="acceso-item">
              <strong>{{ a.programa }}</strong>
              <p>{{ a.desc }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- ── Económica ──────────────────────────────────────────── -->
      <section v-show="activeTab === 'economica'" class="sost-section">
        <div class="section-header">
          <h2>Sostenibilidad Económica</h2>
          <p>Una clínica financieramente sana puede invertir en mejor equipamiento, formación y bienestar animal.</p>
        </div>

        <!-- Fuentes de ingreso -->
        <div class="card sost-card">
          <h3 class="card-title">Diversificación de Ingresos</h3>
          <p class="card-intro">La estabilidad económica se logra no dependiendo de una sola fuente de ingresos.</p>
          <div class="ingresos-grid">
            <div v-for="ing in ingresos" :key="ing.linea" class="ingreso-item">
              <div class="ingreso-header">
                <span class="ingreso-icon">{{ ing.icon }}</span>
                <strong>{{ ing.linea }}</strong>
                <span class="ingreso-pct" :style="{ color: ing.color }">{{ ing.peso }}</span>
              </div>
              <div class="ingreso-bar-wrap">
                <div class="ingreso-bar" :style="{ width: ing.pct + '%', background: ing.color }"></div>
              </div>
              <p>{{ ing.desc }}</p>
            </div>
          </div>
        </div>

        <!-- Planes de salud -->
        <div class="card sost-card highlight-gold">
          <h3 class="card-title">Planes de Salud Preventivos</h3>
          <p class="card-intro">
            Los planes de salud mensuales generan ingresos recurrentes predecibles y fomentan la medicina
            preventiva, que es más barata y menos invasiva que la reactiva.
          </p>
          <div class="planes-grid">
            <div v-for="plan in planesSalud" :key="plan.nombre" :class="['plan-card', { featured: plan.featured }]">
              <div class="plan-nombre">{{ plan.nombre }}</div>
              <div class="plan-precio">{{ plan.precio }}<span>/mes</span></div>
              <ul class="plan-items">
                <li v-for="item in plan.incluye" :key="item">{{ item }}</li>
              </ul>
              <span class="plan-mascota">{{ plan.mascota }}</span>
            </div>
          </div>
        </div>

        <!-- Gestión de costes -->
        <div class="card sost-card">
          <h3 class="card-title">Gestión Eficiente de Costes</h3>
          <div class="costes-list">
            <div v-for="c in gestionCostes" :key="c.area" class="coste-item">
              <span class="coste-icon">{{ c.icon }}</span>
              <div>
                <strong>{{ c.area }}</strong>
                <p>{{ c.medida }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ── Hoja de Ruta ─────────────────────────────────────── -->
      <section v-show="activeTab === 'roadmap'" class="sost-section">
        <div class="section-header">
          <h2>Hoja de Ruta</h2>
          <p>Plan de acción a 12 meses para consolidar la sostenibilidad de la clínica.</p>
        </div>

        <div class="timeline">
          <div v-for="(fase, fi) in roadmap" :key="fi" class="timeline-fase">
            <div class="timeline-marker">
              <div class="timeline-dot"></div>
              <div class="timeline-line" v-if="fi < roadmap.length - 1"></div>
            </div>
            <div class="timeline-content">
              <div class="timeline-header">
                <h3>{{ fase.plazo }}</h3>
                <span class="timeline-range">{{ fase.rango }}</span>
              </div>
              <div class="timeline-items">
                <div v-for="item in fase.items" :key="item.accion" class="timeline-item">
                  <span :class="['tl-cat', item.cat]">{{ item.catLabel }}</span>
                  <span class="tl-accion">{{ item.accion }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- KPIs -->
        <div class="section-header" style="margin-top:3rem">
          <h2>Indicadores Clave (KPIs)</h2>
          <p>Metas medibles para evaluar el avance del plan cada 6 meses.</p>
        </div>
        <div class="kpis-grid">
          <div v-for="grupo in kpis" :key="grupo.dimension" class="card kpi-card">
            <h3 class="kpi-dimension">{{ grupo.icon }} {{ grupo.dimension }}</h3>
            <div class="kpi-list">
              <div v-for="k in grupo.items" :key="k.label" class="kpi-item">
                <div class="kpi-head">
                  <span class="kpi-label">{{ k.label }}</span>
                  <span class="kpi-meta">Objetivo: {{ k.objetivo }}</span>
                </div>
                <div class="kpi-bar-wrap">
                  <div class="kpi-bar" :style="{ width: k.progreso + '%', background: grupo.color }"></div>
                </div>
                <div class="kpi-actual">Situación actual: {{ k.actual }}</div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>

    <!-- CTA -->
    <section class="sost-cta">
      <div class="container sost-cta-inner">
        <div class="sost-cta-text">
          <h2>Un compromiso real con el futuro</h2>
          <p>Este plan se revisa anualmente con la participación del equipo veterinario, los clientes y la comunidad.</p>
        </div>
        <div class="sost-cta-actions">
          <RouterLink to="/contacto" class="btn btn-accent">Contáctanos</RouterLink>
          <RouterLink to="/servicios" class="btn btn-outline-dark">Nuestros Servicios</RouterLink>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref } from 'vue'

const activeTab = ref('ambiental')

const pillars = [
  { icon: '🌿', label: 'Ambiental' },
  { icon: '🐾', label: 'Social' },
  { icon: '💼', label: 'Económica' },
]

const tabs = [
  { id: 'ambiental', icon: '🌿', label: 'Ambiental' },
  { id: 'social',    icon: '🐾', label: 'Social' },
  { id: 'economica', icon: '💼', label: 'Económica' },
  { id: 'roadmap',   icon: '🗺️', label: 'Hoja de Ruta' },
]

// ── Ambiental ────────────────────────────────────────────────────
const metricas = [
  { icon: '♻️', valor: '100%', label: 'Residuos gestionados por empresa autorizada' },
  { icon: '📄', valor: '−80%', label: 'Reducción de papel con historia clínica digital' },
  { icon: '💡', valor: 'LED',  label: 'Iluminación de bajo consumo en toda la clínica' },
  { icon: '🧴', valor: 'Bio',  label: 'Productos de limpieza biodegradables' },
]

const residuos = [
  {
    icon: '🔴', tipo: 'Residuos Sanitarios Peligrosos',
    ejemplos: 'Agujas, bisturís, material cortante, sangre, tejidos',
    gestion: 'Gestor autorizado · Contenedor rígido homologado',
    nivel: 'alto',
  },
  {
    icon: '🟡', tipo: 'Residuos Farmacéuticos',
    ejemplos: 'Medicamentos caducados, envases contaminados, citostáticos',
    gestion: 'SIGRE Veterinaria · Punto de recogida específico',
    nivel: 'medio',
  },
  {
    icon: '🟠', tipo: 'Residuos Biológicos',
    ejemplos: 'Cadáveres, muestras de laboratorio, material orgánico',
    gestion: 'Incineración mediante gestor certificado',
    nivel: 'alto',
  },
  {
    icon: '🟢', tipo: 'Residuos Urbanos Asimilables',
    ejemplos: 'Papel, cartón, plástico no contaminado, embalajes',
    gestion: 'Reciclaje municipal · Contenedores diferenciados',
    nivel: 'bajo',
  },
]

const energiaItems = [
  { accion: 'Iluminación LED en todas las salas',       ahorro: '−60% consumo eléctrico', color: '#f59e0b', desc: 'Sustitución completa de fluorescentes por tecnología LED de bajo consumo, con sensores de presencia en zonas de paso.' },
  { accion: 'Termostato inteligente programado',         ahorro: '−25% climatización',     color: '#f97316', desc: 'Programación horaria de la calefacción y aire acondicionado ajustada al horario de apertura, evitando consumo fuera de horario.' },
  { accion: 'Equipos diagnósticos de bajo consumo',     ahorro: '−30% aparatología',      color: '#eab308', desc: 'Preferencia por equipos de rayos X digitales y ecógrafos con certificación energética A o superior en las próximas renovaciones.' },
  { accion: 'Agua: grifos y cisternas de bajo caudal',  ahorro: '−40% consumo agua',      color: '#22c55e', desc: 'Instalación de aireadores en grifos y cisternas de doble descarga en aseos y área de limpieza quirúrgica.' },
  { accion: 'Limpieza con productos biodegradables',    ahorro: '−100% químicos agresivos', color: '#16a34a', desc: 'Uso exclusivo de desinfectantes de base enzimática y detergentes biodegradables con etiqueta ecológica europea.' },
]

const digitalizacion = [
  { antes: 'Ficha en papel',         despues: 'Historia clínica digital', impacto: '−500 folios/año' },
  { antes: 'Cita por teléfono',      despues: 'Reserva online 24h',       impacto: 'Menos desplazamientos' },
  { antes: 'Receta en papel',        despues: 'Receta electrónica',        impacto: '−100% papel recetas' },
  { antes: 'Factura impresa',        despues: 'Factura por email/PDF',     impacto: '−100% papel facturas' },
  { antes: 'Archivo físico',         despues: 'Nube cifrada',              impacto: 'Sin armarios de archivo' },
]

const criteriosProveedores = [
  { criterio: 'Medicamentos con envase reducido o reciclable',    desc: 'Priorizamos laboratorios que han reducido el plástico en sus embalajes y ofrecen formatos de recarga.' },
  { criterio: 'Alimentación sin ingredientes de pesca no sostenible', desc: 'Para los productos de la tienda, revisamos que el pescado utilizado provenga de fuentes certificadas MSC.' },
  { criterio: 'Proveedores locales o de proximidad',              desc: 'Reducimos la huella de transporte eligiendo distribuidores con almacén en la Comunidad de Madrid siempre que sea posible.' },
  { criterio: 'Material desechable mínimo en cirugía',            desc: 'Equilibrio entre esterilización de material reutilizable y uso de desechable solo cuando la bioseguridad lo requiere.' },
]

// ── Social ───────────────────────────────────────────────────────
const fearFree = [
  { icon: '🏠', area: 'Sala de espera',      desc: 'Separación de zonas para perros y gatos, difusores de feromonas (Feliway / Adaptil), música a baja frecuencia y suelos antideslizantes.' },
  { icon: '🩺', area: 'Consulta',            desc: 'Mantas de olor del hogar del paciente, técnica de mínima restricción, pozos de exploración en altura para gatos.' },
  { icon: '💉', area: 'Procedimientos',      desc: 'Uso de anestesia local previa a inyecciones, snacks de alto valor durante la exploración, descansos si el paciente muestra signos de estrés.' },
  { icon: '🐱', area: 'Protocolo felino',    desc: 'Agenda separada para gatos, sala de espera exclusiva y protocolo de manejo adaptado a sus necesidades específicas.' },
]

const comunidad = [
  { icon: '🏡', iniciativa: 'Colaboración con protectoras y refugios', desc: 'Revisiones veterinarias a precio reducido para animales en acogida y adopción. Convenios activos con protectoras de Madrid.', frecuencia: 'Permanente' },
  { icon: '📚', iniciativa: 'Talleres de educación para propietarios',  desc: 'Charlas gratuitas sobre nutrición, comportamiento, primeros auxilios y tenencia responsable para familias y colegios.', frecuencia: 'Trimestral' },
  { icon: '🐕', iniciativa: 'Jornadas de adopción responsable',         desc: 'Eventos en colaboración con el Ayuntamiento para promover la adopción y la identificación/esterilización de animales.', frecuencia: 'Semestral' },
  { icon: '💊', iniciativa: 'Programa "Mascotas sin barreras"',          desc: 'Descuentos del 20% en consultas básicas para personas mayores de 65 años y familias en situación de vulnerabilidad.', frecuencia: 'Permanente' },
  { icon: '🎓', iniciativa: 'Prácticas para estudiantes de veterinaria', desc: 'Acuerdo con la Facultad de Veterinaria de la UCM para recibir estudiantes en prácticas supervisadas.', frecuencia: 'Anual' },
]

const equipo = [
  { icon: '📖', area: 'Formación continua',      desc: 'Cada veterinario dispone de 40 horas anuales para cursos, congresos y certificaciones (Fear Free, cirugía, dermatología).' },
  { icon: '⚖️', area: 'Conciliación familiar',   desc: 'Flexibilidad horaria para citas médicas propias y de hijos, posibilidad de teletrabajo para tareas administrativas.' },
  { icon: '🧠', area: 'Salud mental del equipo', desc: 'Sesiones de supervisión grupal ante situaciones de estrés compasivo (burnout veterinario), acceso a psicólogo de empresa.' },
  { icon: '📈', area: 'Plan de carrera',          desc: 'Promoción interna, especialización por áreas de interés y participación en decisiones clínicas del equipo.' },
]

const accesibilidad = [
  { programa: 'Planes de salud mensuales',  desc: 'Cuotas desde 15 €/mes que incluyen revisiones, vacunas y desparasitaciones, haciendo la medicina preventiva accesible.' },
  { programa: 'Presupuesto previo gratuito', desc: 'Antes de cualquier procedimiento, el propietario recibe un presupuesto detallado sin coste para que pueda decidir con información.' },
  { programa: 'Financiación sin intereses', desc: 'Para tratamientos de más de 200 €, ofrecemos fraccionamiento en hasta 6 cuotas sin intereses en colaboración con entidades financieras.' },
  { programa: 'Descuento para mayores y vulnerables', desc: '20% de descuento en consulta general para personas mayores de 65 años y familias acreditadas por servicios sociales.' },
]

// ── Económica ────────────────────────────────────────────────────
const ingresos = [
  { icon: '🩺', linea: 'Consultas y diagnóstico', peso: '45%', pct: 45, color: '#6366f1', desc: 'Consultas generales, urgencias, laboratorio, ecografías y radiografías digitales.' },
  { icon: '💉', linea: 'Cirugía y hospitalización', peso: '25%', pct: 25, color: '#8b5cf6', desc: 'Cirugía programada y de urgencia, hospitalización de 24h, cuidados postoperatorios.' },
  { icon: '🛍️', linea: 'Tienda y nutrición',        peso: '15%', pct: 15, color: '#f59e0b', desc: 'Venta de piensos, medicamentos, accesorios y productos de higiene en clínica y online.' },
  { icon: '💳', linea: 'Planes de salud',            peso: '10%', pct: 10, color: '#22c55e', desc: 'Cuotas mensuales con cobertura preventiva: vacunas, desparasitaciones, revisiones.' },
  { icon: '✂️', linea: 'Peluquería y estética',      peso: '5%',  pct: 5,  color: '#ec4899', desc: 'Baño, corte y arreglo estético con productos hipoalergénicos y biodegradables.' },
]

const planesSalud = [
  {
    nombre: 'Plan Cachorro/Gatito',
    precio: '15 €',
    incluye: ['Vacunación completa del primer año', 'Desparasitaciones internas y externas', '2 revisiones incluidas', 'Microchip y registro'],
    mascota: 'Para menores de 12 meses',
    featured: false,
  },
  {
    nombre: 'Plan Adulto',
    precio: '12 €',
    incluye: ['Vacuna anual antirrábica + combinada', 'Desparasitación trimestral', '1 revisión anual', 'Descuento 15% en consultas'],
    mascota: 'Para 1–8 años',
    featured: true,
  },
  {
    nombre: 'Plan Senior',
    precio: '18 €',
    incluye: ['Vacunas + analítica anual', 'Desparasitación trimestral', '2 revisiones incluidas', 'Control de tensión y peso'],
    mascota: 'Para mayores de 8 años',
    featured: false,
  },
]

const gestionCostes = [
  { icon: '💊', area: 'Stock de medicamentos',      medida: 'Sistema de inventario rotativo con pedido automático al llegar al stock mínimo, evitando caducidades y exceso de almacén.' },
  { icon: '🔧', area: 'Mantenimiento preventivo',   medida: 'Contrato anual de mantenimiento de equipos de diagnóstico (ecógrafo, rayos X) para evitar averías costosas y garantizar precisión.' },
  { icon: '⚡', area: 'Eficiencia energética',       medida: 'Reducción de la factura eléctrica con LED y termostato inteligente: ahorro estimado de 1.200 €/año.' },
  { icon: '📊', area: 'Análisis mensual de costes', medida: 'Revisión mensual de márgenes por servicio para identificar ineficiencias y ajustar precios de forma transparente.' },
  { icon: '🤝', area: 'Acuerdos con proveedores',   medida: 'Negociación de rappels por volumen con laboratorios farmacéuticos y distribuidores de alimentación animal.' },
]

// ── Hoja de Ruta ─────────────────────────────────────────────────
const roadmap = [
  {
    plazo: 'Corto Plazo',
    rango: '0–3 meses',
    items: [
      { accion: 'Contrato con gestor autorizado de residuos sanitarios',         cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Historia clínica 100% digital para todos los pacientes',        cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Lanzamiento de los tres planes de salud preventivos',           cat: 'eco', catLabel: 'Económica' },
      { accion: 'Protocolo Fear Free en consulta de felinos',                    cat: 'soc', catLabel: 'Social' },
      { accion: 'Primer taller gratuito de nutrición para propietarios',         cat: 'soc', catLabel: 'Social' },
      { accion: 'Sustitución de limpiadores convencionales por biodegradables',  cat: 'amb', catLabel: 'Ambiental' },
    ],
  },
  {
    plazo: 'Medio Plazo',
    rango: '3–12 meses',
    items: [
      { accion: 'Convenio formal con 2 protectoras de la Comunidad de Madrid',   cat: 'soc', catLabel: 'Social' },
      { accion: 'Sustitución progresiva de iluminación a LED',                   cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Implementar presupuesto previo digital en la plataforma',       cat: 'eco', catLabel: 'Económica' },
      { accion: 'Programa de descuento para mayores y familias vulnerables',     cat: 'soc', catLabel: 'Social' },
      { accion: 'Auditoría de proveedores con criterios de sostenibilidad',      cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Financiación sin intereses para tratamientos >200 €',           cat: 'eco', catLabel: 'Económica' },
      { accion: 'Acuerdo de prácticas con Facultad de Veterinaria UCM',          cat: 'soc', catLabel: 'Social' },
    ],
  },
  {
    plazo: 'Largo Plazo',
    rango: '12+ meses',
    items: [
      { accion: 'Certificación ambiental ISO 14001 o similar',                   cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Instalación de paneles solares o compra de energía verde',      cat: 'amb', catLabel: 'Ambiental' },
      { accion: 'Expansión del programa de peluquería con productos ecológicos', cat: 'eco', catLabel: 'Económica' },
      { accion: 'Publicación anual de memoria de sostenibilidad',                cat: 'soc', catLabel: 'Social' },
    ],
  },
]

const kpis = [
  {
    dimension: 'Ambiental',
    icon: '🌿',
    color: '#22c55e',
    items: [
      { label: 'Reducción de papel',                actual: 'Sin medir',          objetivo: '−80% en 12 meses',  progreso: 0 },
      { label: 'Residuos correctamente segregados',  actual: 'Parcial',            objetivo: '100%',              progreso: 40 },
      { label: 'Consumo eléctrico mensual',          actual: '~800 kWh/mes',       objetivo: '< 550 kWh/mes',     progreso: 20 },
    ],
  },
  {
    dimension: 'Social',
    icon: '🐾',
    color: '#f59e0b',
    items: [
      { label: 'Animales atendidos en protectoras',  actual: '0 convenios activos', objetivo: '50+ animales/año', progreso: 0 },
      { label: 'Talleres realizados',                actual: '0',                   objetivo: '4 al año',         progreso: 0 },
      { label: 'Satisfacción clientes (encuesta)',   actual: '98% según reseñas',   objetivo: '> 95% formal',     progreso: 80 },
    ],
  },
  {
    dimension: 'Económica',
    icon: '💼',
    color: '#6366f1',
    items: [
      { label: 'Clientes con plan de salud',         actual: '0 (lanzamiento)',     objetivo: '15% de la cartera', progreso: 0 },
      { label: 'Ingresos tienda online',             actual: 'En operación',        objetivo: '+20% en 12 meses',  progreso: 30 },
      { label: 'Ahorro en costes operativos',        actual: 'Sin medir',           objetivo: '−15% en 12 meses',  progreso: 5 },
    ],
  },
]
</script>

<style scoped>
.sost-page { background: var(--cream, #faf9f6); }

/* ── Hero ─────────────────────────────────────────── */
.sost-hero {
  position: relative; overflow: hidden;
  padding: 5rem 0 4rem;
  background: linear-gradient(135deg, #0f2c1a 0%, #1a4a2e 60%, #22613c 100%);
  color: #fff;
}
.sost-hero-bg { position: absolute; inset: 0; pointer-events: none; }
.sost-orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: .18; }
.sost-orb-1 { width: 500px; height: 500px; background: #4ade80; top: -150px; right: -100px; }
.sost-orb-2 { width: 350px; height: 350px; background: #86efac; bottom: -100px; left: -50px; }
.sost-hero-inner { position: relative; text-align: center; }
.sost-badge {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
  border-radius: 99px; padding: .35rem 1rem;
  font-size: .8rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
  margin-bottom: 1.5rem; color: #bbf7d0;
}
.sost-hero h1 { font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 800; margin-bottom: 1rem; }
.sost-hero h1 em { font-style: normal; color: #4ade80; }
.sost-hero-desc { max-width: 560px; margin: 0 auto 2rem; opacity: .8; line-height: 1.7; font-size: 1.05rem; }
.sost-pillars { display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; }
.sost-pillar {
  display: flex; align-items: center; gap: .4rem;
  background: rgba(255,255,255,.1); border-radius: 99px;
  padding: .4rem 1.1rem; font-size: .9rem; font-weight: 600;
}

/* ── Tabs ─────────────────────────────────────────── */
.sost-tabs-bar {
  background: #fff; border-bottom: 1px solid #e5e7eb;
  position: sticky; top: 0; z-index: 50;
}
.sost-tabs { display: flex; overflow-x: auto; }
.sost-tab {
  display: flex; align-items: center; gap: .4rem;
  padding: .9rem 1.4rem; border: none; background: none;
  font-size: .9rem; font-weight: 600; color: #6b7280;
  cursor: pointer; white-space: nowrap;
  border-bottom: 2px solid transparent; transition: all .2s;
}
.sost-tab:hover { color: #1a4a2e; }
.sost-tab.active { color: #1a4a2e; border-bottom-color: #22c55e; }

/* ── Body ─────────────────────────────────────────── */
.sost-body { padding: 2.5rem 0 4rem; }
.sost-section { animation: fadeIn .3s ease; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; } }
.section-header { margin-bottom: 2rem; }
.section-header h2 { font-size: 1.6rem; font-weight: 800; color: #0f2c1a; margin-bottom: .4rem; }
.section-header p { color: #6b7280; }
.sost-card { margin-bottom: 1.5rem; padding: 1.75rem 2rem; }
.card-title { font-size: 1.05rem; font-weight: 700; color: #0f2c1a; margin-bottom: .75rem; }
.card-intro { font-size: .9rem; color: #4b5563; line-height: 1.7; margin-bottom: 1.25rem; }
.highlight-green { border-left: 4px solid #22c55e; }
.highlight-blue   { border-left: 4px solid #6366f1; }
.highlight-gold   { border-left: 4px solid #f59e0b; }

/* ── Métricas ─────────────────────────────────────── */
.metrics-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
.metric-card { background: #fff; border-radius: 12px; padding: 1.25rem; text-align: center; box-shadow: 0 1px 4px rgba(0,0,0,.07); }
.metric-icon { font-size: 1.6rem; margin-bottom: .4rem; }
.metric-value { font-size: 1.5rem; font-weight: 800; color: #166534; }
.metric-label { font-size: .78rem; color: #6b7280; margin-top: .25rem; line-height: 1.4; }

/* ── Residuos ─────────────────────────────────────── */
.residuos-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; }
.residuo-card { display: flex; gap: .9rem; background: #f9fafb; border-radius: 10px; padding: 1rem; align-items: flex-start; }
.residuo-icon { font-size: 1.4rem; flex-shrink: 0; }
.residuo-body { display: flex; flex-direction: column; gap: .25rem; }
.residuo-body strong { font-size: .88rem; color: #1f2937; }
.residuo-ejemplos { font-size: .78rem; color: #6b7280; line-height: 1.5; }
.residuo-gestion { font-size: .75rem; font-weight: 700; padding: .2rem .55rem; border-radius: 99px; width: fit-content; margin-top: .2rem; }
.residuo-gestion.alto  { background: #fee2e2; color: #991b1b; }
.residuo-gestion.medio { background: #fef3c7; color: #92400e; }
.residuo-gestion.bajo  { background: #dcfce7; color: #166534; }

/* ── Energía ──────────────────────────────────────── */
.energia-list { display: flex; flex-direction: column; gap: .85rem; }
.energia-item { display: flex; gap: 1rem; align-items: flex-start; }
.energia-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; margin-top: 6px; }
.energia-body { flex: 1; }
.energia-head { display: flex; align-items: baseline; gap: .75rem; margin-bottom: .25rem; flex-wrap: wrap; }
.energia-head strong { font-size: .9rem; color: #1f2937; }
.energia-ahorro { font-size: .78rem; font-weight: 700; color: #166534; background: #dcfce7; padding: .1rem .5rem; border-radius: 99px; }
.energia-body p { font-size: .85rem; color: #6b7280; margin: 0; line-height: 1.6; }

/* ── Digitalización ───────────────────────────────── */
.digital-grid { display: flex; flex-direction: column; gap: .6rem; }
.digital-item { display: flex; align-items: center; gap: .75rem; padding: .6rem .9rem; background: #f0fdf4; border-radius: 8px; flex-wrap: wrap; }
.digital-antes { font-size: .83rem; color: #6b7280; text-decoration: line-through; }
.digital-arrow { color: #22c55e; font-weight: 800; }
.digital-despues { font-size: .85rem; font-weight: 600; color: #166534; flex: 1; }
.digital-impacto { font-size: .75rem; font-weight: 700; background: #dcfce7; color: #166534; padding: .15rem .55rem; border-radius: 99px; white-space: nowrap; }

/* ── Proveedores ──────────────────────────────────── */
.proveedores-list { display: flex; flex-direction: column; gap: .75rem; }
.proveedor-item { display: flex; gap: .75rem; align-items: flex-start; }
.check-verde { color: #22c55e; font-weight: 900; font-size: 1.1rem; flex-shrink: 0; margin-top: 2px; }
.proveedor-item strong { font-size: .9rem; color: #1f2937; display: block; margin-bottom: .2rem; }
.proveedor-item p { font-size: .83rem; color: #6b7280; margin: 0; line-height: 1.6; }

/* ── Fear Free ────────────────────────────────────── */
.fearfree-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
.fearfree-item { display: flex; gap: .8rem; background: #f9fafb; border-radius: 10px; padding: 1rem; align-items: flex-start; }
.fearfree-icon { font-size: 1.4rem; flex-shrink: 0; }
.fearfree-item strong { font-size: .88rem; color: #1f2937; display: block; margin-bottom: .3rem; }
.fearfree-item p { font-size: .82rem; color: #6b7280; margin: 0; line-height: 1.6; }

/* ── Comunidad ────────────────────────────────────── */
.comunidad-list { display: flex; flex-direction: column; gap: 1rem; }
.comunidad-item { display: flex; gap: 1rem; align-items: flex-start; }
.comunidad-icon { font-size: 1.5rem; flex-shrink: 0; }
.comunidad-body strong { font-size: .9rem; color: #1f2937; display: block; margin-bottom: .2rem; }
.comunidad-body p { font-size: .84rem; color: #6b7280; line-height: 1.6; margin: 0 0 .3rem; }
.comunidad-freq { font-size: .75rem; font-weight: 700; background: #e0e7ff; color: #3730a3; padding: .15rem .55rem; border-radius: 99px; }

/* ── Equipo ───────────────────────────────────────── */
.equipo-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
.equipo-item { display: flex; gap: .8rem; background: #f9fafb; border-radius: 10px; padding: 1rem; align-items: flex-start; }
.equipo-icon { font-size: 1.3rem; flex-shrink: 0; }
.equipo-item strong { font-size: .88rem; color: #1f2937; display: block; margin-bottom: .3rem; }
.equipo-item p { font-size: .82rem; color: #6b7280; margin: 0; line-height: 1.6; }

/* ── Accesibilidad ────────────────────────────────── */
.acceso-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
.acceso-item { background: #eef2ff; border-radius: 10px; padding: 1rem; }
.acceso-item strong { font-size: .88rem; color: #3730a3; display: block; margin-bottom: .35rem; }
.acceso-item p { font-size: .83rem; color: #4b5563; margin: 0; line-height: 1.6; }

/* ── Ingresos ─────────────────────────────────────── */
.ingresos-grid { display: flex; flex-direction: column; gap: 1.1rem; }
.ingreso-item { display: flex; flex-direction: column; gap: .4rem; }
.ingreso-header { display: flex; align-items: center; gap: .6rem; }
.ingreso-icon { font-size: 1.1rem; }
.ingreso-header strong { flex: 1; font-size: .9rem; color: #1f2937; }
.ingreso-pct { font-size: .82rem; font-weight: 800; }
.ingreso-bar-wrap { height: 8px; background: #e5e7eb; border-radius: 99px; overflow: hidden; }
.ingreso-bar { height: 100%; border-radius: 99px; transition: width .5s; }
.ingreso-item p { font-size: .82rem; color: #6b7280; margin: 0; }

/* ── Planes ───────────────────────────────────────── */
.planes-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; }
.plan-card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.25rem; display: flex; flex-direction: column; gap: .5rem; }
.plan-card.featured { border-color: #f59e0b; background: #fffbeb; }
.plan-nombre { font-size: .85rem; font-weight: 700; color: #374151; }
.plan-precio { font-size: 1.8rem; font-weight: 800; color: #1a4a2e; line-height: 1; }
.plan-precio span { font-size: .85rem; font-weight: 400; color: #6b7280; }
.plan-items { list-style: none; display: flex; flex-direction: column; gap: .35rem; margin-top: .25rem; }
.plan-items li { font-size: .82rem; color: #4b5563; padding-left: 1rem; position: relative; }
.plan-items li::before { content: '✓'; position: absolute; left: 0; color: #22c55e; font-weight: 700; }
.plan-mascota { font-size: .75rem; color: #9ca3af; margin-top: .25rem; }

/* ── Costes ───────────────────────────────────────── */
.costes-list { display: flex; flex-direction: column; gap: .75rem; }
.coste-item { display: flex; gap: .9rem; align-items: flex-start; padding: .75rem 1rem; background: #f9fafb; border-radius: 8px; }
.coste-icon { font-size: 1.3rem; flex-shrink: 0; }
.coste-item strong { font-size: .88rem; color: #1f2937; display: block; margin-bottom: .2rem; }
.coste-item p { font-size: .83rem; color: #6b7280; margin: 0; line-height: 1.6; }

/* ── Timeline ─────────────────────────────────────── */
.timeline { display: flex; flex-direction: column; }
.timeline-fase { display: flex; gap: 1.25rem; }
.timeline-marker { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
.timeline-dot { width: 16px; height: 16px; border-radius: 50%; background: #22c55e; border: 3px solid #fff; box-shadow: 0 0 0 2px #22c55e; }
.timeline-line { width: 2px; flex: 1; background: #d1fae5; margin: 4px 0; min-height: 20px; }
.timeline-content { flex: 1; padding-bottom: 2.5rem; }
.timeline-header { display: flex; align-items: baseline; gap: .75rem; margin-bottom: 1rem; }
.timeline-header h3 { font-size: 1.1rem; font-weight: 800; color: #0f2c1a; }
.timeline-range { font-size: .82rem; color: #6b7280; }
.timeline-items { display: flex; flex-direction: column; gap: .5rem; }
.timeline-item { display: flex; align-items: center; gap: .75rem; padding: .6rem .9rem; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; flex-wrap: wrap; }
.tl-cat { font-size: .72rem; font-weight: 700; padding: .2rem .55rem; border-radius: 99px; white-space: nowrap; }
.tl-cat.amb { background: #dcfce7; color: #166534; }
.tl-cat.soc { background: #fef3c7; color: #92400e; }
.tl-cat.eco { background: #ede9fe; color: #5b21b6; }
.tl-accion { flex: 1; font-size: .88rem; color: #374151; }

/* ── KPIs ─────────────────────────────────────────── */
.kpis-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; }
.kpi-card { padding: 1.5rem; }
.kpi-dimension { font-size: 1rem; font-weight: 800; color: #0f2c1a; margin-bottom: 1.25rem; }
.kpi-list { display: flex; flex-direction: column; gap: 1.1rem; }
.kpi-item { display: flex; flex-direction: column; gap: .3rem; }
.kpi-head { display: flex; justify-content: space-between; align-items: baseline; }
.kpi-label { font-size: .88rem; font-weight: 600; color: #374151; }
.kpi-meta { font-size: .75rem; color: #6b7280; }
.kpi-bar-wrap { height: 6px; background: #e5e7eb; border-radius: 99px; overflow: hidden; }
.kpi-bar { height: 100%; border-radius: 99px; transition: width .5s; }
.kpi-actual { font-size: .75rem; color: #9ca3af; }

/* ── CTA ──────────────────────────────────────────── */
.sost-cta { background: linear-gradient(135deg, #0f2c1a, #1a4a2e); padding: 3.5rem 0; color: #fff; margin-top: 2rem; }
.sost-cta-inner { display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap; }
.sost-cta-text h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: .5rem; }
.sost-cta-text p { opacity: .75; font-size: .95rem; max-width: 480px; }
.sost-cta-actions { display: flex; gap: 1rem; flex-wrap: wrap; }

@media (max-width: 700px) {
  .sost-cta-inner { flex-direction: column; text-align: center; }
  .sost-cta-actions { justify-content: center; }
  .timeline-item { flex-direction: column; align-items: flex-start; }
}
</style>
