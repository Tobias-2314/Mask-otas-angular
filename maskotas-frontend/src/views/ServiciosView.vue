<template>
  <div>
    <!-- Header -->
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Lo que hacemos</span>
        <h1>Nuestros <em>Servicios</em></h1>
        <p>Ofrecemos una gama completa de servicios veterinarios para garantizar la salud y felicidad de tu mascota.</p>
      </div>
    </section>

    <!-- Servicios grid -->
    <section class="services-main">
      <div class="container">
        <div class="services-grid">
          <div class="service-card" v-for="(s, i) in servicios" :key="s.titulo" :class="`fade-up-${(i % 5) + 1}`">
            <div class="service-icon-wrap" :style="`background: ${s.bg}`">
              <span class="service-icon" v-html="s.svg"></span>
            </div>
            <div class="service-body">
              <h3>{{ s.titulo }}</h3>
              <p>{{ s.descripcion }}</p>
              <RouterLink to="/citas" class="service-link">
                Agendar cita
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="servicios-cta">
      <div class="container cta-inner">
        <div class="cta-text">
          <h2>¿Necesitas una consulta urgente?</h2>
          <p>Llámanos al <a href="tel:+34912345678" class="phone-link">+34 912 345 678</a> o agenda una cita online.</p>
        </div>
        <RouterLink to="/citas" class="btn btn-accent btn-lg">Agendar Cita</RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
const servicios = [
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>`,
    bg: 'rgba(74,124,89,.1)',
    titulo: 'Consulta General',
    descripcion: 'Chequeos rutinarios y diagnóstico integral para mantener a tu mascota en perfecto estado de salud.'
  },
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M3 3l6 6m2.5-2.5 1-1M9 9l8 8M15 9l4-4m-4 4 4 4"/></svg>`,
    bg: 'rgba(201,168,76,.1)',
    titulo: 'Vacunación',
    descripcion: 'Protege a tu mejor amigo contra enfermedades comunes con nuestro esquema completo de vacunación.'
  },
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/></svg>`,
    bg: 'rgba(196,114,84,.1)',
    titulo: 'Peluquería & Spa',
    descripcion: 'Baños, cortes y tratamientos estéticos para que tu mascota luzca y se sienta increíble.'
  },
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M8 12s1.5-2 4-2 4 2 4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>`,
    bg: 'rgba(74,124,89,.08)',
    titulo: 'Odontología',
    descripcion: 'Limpieza dental y tratamientos para mantener la salud bucal de tu mascota en óptimas condiciones.'
  },
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11l-5 5h16l-5-5V3"/></svg>`,
    bg: 'rgba(201,168,76,.08)',
    titulo: 'Laboratorio',
    descripcion: 'Análisis clínicos y diagnóstico por imagen con equipos de última generación para resultados precisos.'
  },
  {
    svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>`,
    bg: 'rgba(192,57,43,.08)',
    titulo: 'Cirugía',
    descripcion: 'Intervenciones quirúrgicas de alta complejidad realizadas por un equipo de especialistas certificados.'
  },
]
</script>

<style scoped>
.page-hero {
  background: var(--deep);
  color: var(--cream);
  padding: 5rem 0 4rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 70% 50%, rgba(26,61,31,.8) 0%, transparent 70%);
  pointer-events: none;
}
.page-hero .container { position: relative; z-index: 1; }
.eyebrow {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 0.75rem;
}
.page-hero h1 {
  font-size: clamp(2.2rem, 5vw, 4rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 1rem;
}
.page-hero h1 em { font-style: italic; color: var(--gold-light); }
.page-hero p {
  color: rgba(250,246,238,.65);
  max-width: 520px;
  margin: 0 auto;
  font-size: 1rem;
  line-height: 1.7;
}

.services-main { padding: 5rem 0; background: var(--cream); }
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}
.service-card {
  background: #fff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.service-card:hover { transform: translateY(-6px); box-shadow: var(--shadow); }

.service-icon-wrap {
  padding: 1.75rem 1.75rem 0;
  display: flex;
}
.service-icon {
  width: 52px; height: 52px;
  border-radius: 14px;
  background: inherit;
  display: flex; align-items: center; justify-content: center;
  color: var(--sage);
  border: 1px solid rgba(74,124,89,.15);
}
.service-icon :deep(svg) { display: block; }

.service-body {
  padding: 1.25rem 1.75rem 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
  flex: 1;
}
.service-body h3 {
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--deep);
}
.service-body p {
  font-size: 0.9rem;
  color: var(--text-muted);
  line-height: 1.7;
  flex: 1;
}
.service-link {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--sage);
  transition: gap 0.2s, color 0.2s;
  margin-top: 0.25rem;
}
.service-link:hover { color: var(--forest); gap: 0.65rem; }

.servicios-cta {
  background: var(--forest);
  padding: 4rem 0;
}
.cta-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  flex-wrap: wrap;
}
.cta-text h2 {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 0.4rem;
}
.cta-text p { font-size: 0.95rem; color: rgba(250,246,238,.65); }
.phone-link { color: var(--gold-light); text-decoration: underline; text-decoration-color: rgba(201,168,76,.4); }
</style>
