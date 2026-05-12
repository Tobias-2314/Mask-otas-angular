<template>
  <div>
    <!-- Hero -->
    <section class="hero">
      <div class="container hero-inner">
        <div class="hero-text">
          <h1>Tu mascota, <br>nuestra prioridad.</h1>
          <p>Servicios veterinarios de primera clase con un equipo apasionado por el bienestar animal.</p>
          <div class="hero-btns">
            <RouterLink to="/citas" class="btn btn-white">Agendar Cita</RouterLink>
            <RouterLink to="/servicios" class="btn btn-outline-white">Ver Servicios</RouterLink>
          </div>
        </div>
      </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="features-section">
      <div class="container">
        <div style="text-align:center;margin-bottom:2.5rem">
          <h2 style="font-size:1.8rem;font-weight:800;margin-bottom:.5rem">¿Por qué elegirnos?</h2>
          <p style="color:var(--muted);max-width:560px;margin:0 auto">Combinamos experiencia médica con un trato humano y cercano para que tú y tu mascota se sientan en casa.</p>
        </div>
        <div class="features-grid">
          <div class="feature-card card">
            <div class="feature-icon" style="background:#e0e7ff;color:#4f46e5">❤️</div>
            <h3>Atención con Amor</h3>
            <p>Tratamos a cada paciente como si fuera nuestra propia mascota, con paciencia y cariño.</p>
          </div>
          <div class="feature-card card">
            <div class="feature-icon" style="background:#ede9fe;color:#7c3aed">🩺</div>
            <h3>Tecnología Avanzada</h3>
            <p>Equipos de diagnóstico de última generación para resultados precisos y rápidos.</p>
          </div>
          <div class="feature-card card">
            <div class="feature-icon" style="background:#fce7f3;color:#db2777">📅</div>
            <h3>Citas Flexibles</h3>
            <p>Horarios extendidos y sistema de reservas online para tu máxima comodidad.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Reseñas recientes -->
    <section class="reviews-section">
      <div class="container">
        <div style="text-align:center;margin-bottom:2rem">
          <h2 style="font-size:1.8rem;font-weight:800;margin-bottom:.5rem">Clientes Felices</h2>
          <p style="color:var(--muted)">Estas son algunas de las experiencias de nuestros clientes más recientes.</p>
        </div>
        <div v-if="loading" class="loading">Cargando reseñas…</div>
        <div v-else class="reviews-grid">
          <div v-for="r in resenas" :key="r.id" class="card review-card">
            <div class="stars">{{ '★'.repeat(r.calificacion) }}{{ '☆'.repeat(5 - r.calificacion) }}</div>
            <p class="review-text">"{{ r.comentario }}"</p>
            <div class="review-footer">
              <div class="avatar">{{ (r.usuario?.nombre || 'A').charAt(0).toUpperCase() }}</div>
              <span class="review-author">{{ r.usuario?.nombre || 'Anónimo' }}</span>
            </div>
          </div>
        </div>
        <div style="text-align:center;margin-top:2rem">
          <RouterLink to="/resenas" class="btn btn-primary">Ver todas las reseñas</RouterLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getUltimas } from '../api/resenas'

const resenas = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await getUltimas()
    resenas.value = data
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.hero {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: #fff; padding: 5rem 0;
}
.hero-inner { text-align: center; }
.hero-text { max-width: 640px; margin: 0 auto; }
.hero h1 { font-size: 2.6rem; font-weight: 800; margin-bottom: .75rem; line-height: 1.15; }
.hero p  { font-size: 1.1rem; opacity: .9; margin-bottom: 2rem; }
.hero-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.btn-white { background: #fff; color: var(--primary); font-weight: 700; border: none; }
.btn-white:hover { background: #f3f4f6; }
.btn-outline-white { background: transparent; border: 2px solid #fff; color: #fff; font-weight: 700; }
.btn-outline-white:hover { background: #fff; color: var(--primary); }

.features-section { padding: 4rem 0; background: #fff; }
.features-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
.feature-card { display: flex; flex-direction: column; gap: .75rem; transition: transform .2s; }
.feature-card:hover { transform: translateY(-3px); }
.feature-icon { width: 3.5rem; height: 3.5rem; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; }
.feature-card h3 { font-size: 1rem; font-weight: 700; }
.feature-card p { font-size: .9rem; color: var(--muted); }

.reviews-section { padding: 4rem 0; background: #f9fafb; }
.reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem; }
.review-card { display: flex; flex-direction: column; gap: .5rem; }
.stars { font-size: 1.1rem; color: #f59e0b; }
.review-text { font-style: italic; color: var(--muted); font-size: .95rem; flex: 1; }
.review-footer { display: flex; align-items: center; gap: .6rem; margin-top: .25rem; }
.avatar {
  width: 2rem; height: 2rem; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), #7c3aed);
  color: #fff; display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: .8rem;
}
.review-author { font-size: .85rem; font-weight: 600; color: var(--primary); }
</style>
