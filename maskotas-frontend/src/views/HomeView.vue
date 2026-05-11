<template>
  <div>
    <section class="hero">
      <div class="container hero-inner">
        <h1>El mejor cuidado para tu mascota</h1>
        <p>Productos, servicios veterinarios y citas en un solo lugar.</p>
        <div class="hero-btns">
          <RouterLink to="/tienda" class="btn btn-primary">Ver tienda</RouterLink>
          <RouterLink to="/citas" class="btn btn-accent">Agendar cita</RouterLink>
        </div>
      </div>
    </section>

    <section class="container section">
      <h2 class="section-title">Lo que dicen nuestros clientes</h2>
      <div v-if="loading" class="loading">Cargando reseñas…</div>
      <div v-else class="reviews-grid">
        <div v-for="r in resenas" :key="r.id" class="card review-card">
          <div class="stars">{{ '★'.repeat(r.calificacion) }}{{ '☆'.repeat(5 - r.calificacion) }}</div>
          <p class="review-text">"{{ r.comentario }}"</p>
          <span class="review-author">— {{ r.usuario.nombre }}</span>
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
.hero h1 { font-size: 2.4rem; font-weight: 800; margin-bottom: .75rem; }
.hero p  { font-size: 1.1rem; opacity: .9; margin-bottom: 2rem; }
.hero-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

.section { margin-top: 3rem; }
.section-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; }
.reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem; }
.review-card { display: flex; flex-direction: column; gap: .5rem; }
.stars { font-size: 1.1rem; color: #f59e0b; }
.review-text { font-style: italic; color: var(--muted); font-size: .95rem; }
.review-author { font-size: .85rem; font-weight: 600; color: var(--primary); }
</style>
