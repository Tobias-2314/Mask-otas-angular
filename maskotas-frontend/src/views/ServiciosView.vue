<template>
  <div class="container">
    <div class="page-header" style="text-align:center">
      <h1>Nuestros Servicios</h1>
      <p style="color:var(--muted);max-width:560px;margin:.5rem auto 0">Ofrecemos una gama completa de servicios veterinarios para garantizar la salud y felicidad de tu mascota.</p>
    </div>

    <div class="services-grid">
      <div class="service-card card" v-for="s in servicios" :key="s.titulo">
        <div class="service-icon" :style="`background:${s.bg};color:${s.color}`">{{ s.emoji }}</div>
        <h3>{{ s.titulo }}</h3>
        <p>{{ s.descripcion }}</p>
        <RouterLink to="/citas" class="btn btn-outline btn-sm">Agendar &rarr;</RouterLink>
      </div>
    </div>

    <div class="cta-section card">
      <h2>¿Necesitas una consulta urgente?</h2>
      <p>Llámanos al <strong>+34 912 345 678</strong> o agenda una cita online.</p>
      <RouterLink to="/citas" class="btn btn-primary" style="margin-top:1rem">Agendar Cita</RouterLink>
    </div>
  </div>
</template>

<script setup>
const servicios = [
  { emoji: '🩺', bg: '#e0e7ff', color: '#4f46e5', titulo: 'Consulta General', descripcion: 'Chequeos rutinarios y diagnóstico integral para mantener a tu mascota en perfecto estado de salud.' },
  { emoji: '💉', bg: '#ede9fe', color: '#7c3aed', titulo: 'Vacunación', descripcion: 'Protege a tu mejor amigo contra enfermedades comunes con nuestro esquema completo de vacunación.' },
  { emoji: '✂️', bg: '#fce7f3', color: '#db2777', titulo: 'Peluquería & Spa', descripcion: 'Baños, cortes y tratamientos estéticos para que tu mascota luzca y se sienta increíble.' },
  { emoji: '🦷', bg: '#d1fae5', color: '#059669', titulo: 'Odontología', descripcion: 'Limpieza dental y tratamientos para mantener la salud bucal de tu mascota en óptimas condiciones.' },
  { emoji: '🔬', bg: '#fef3c7', color: '#d97706', titulo: 'Laboratorio', descripcion: 'Análisis clínicos y diagnóstico por imagen con equipos de última generación para resultados precisos.' },
  { emoji: '🏥', bg: '#fee2e2', color: '#dc2626', titulo: 'Cirugía', descripcion: 'Intervenciones quirúrgicas de alta complejidad realizadas por un equipo de especialistas certificados.' },
]
</script>

<style scoped>
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}
.service-card { display: flex; flex-direction: column; gap: .75rem; transition: transform .2s; }
.service-card:hover { transform: translateY(-3px); }
.service-icon {
  width: 4rem; height: 4rem; border-radius: 14px;
  display: flex; align-items: center; justify-content: center; font-size: 2rem;
}
.service-card h3 { font-size: 1.05rem; font-weight: 700; }
.service-card p { font-size: .9rem; color: var(--muted); flex: 1; }

.cta-section { text-align: center; padding: 2.5rem; background: linear-gradient(135deg,#f0f4ff,#faf5ff); }
.cta-section h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: .5rem; }
.cta-section p { color: var(--muted); }
</style>
