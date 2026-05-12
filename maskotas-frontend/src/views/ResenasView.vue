<template>
  <div class="container">
    <div class="page-header" style="text-align:center">
      <h1>Lo que dicen nuestros clientes</h1>
      <p style="color:var(--muted)">Nuestra mejor garantía es la satisfacción de nuestras mascotas y sus dueños.</p>
    </div>

    <div v-if="loading" class="loading">Cargando reseñas…</div>
    <div v-else-if="resenas.length === 0" class="loading">Aún no hay reseñas. ¡Sé el primero!</div>
    <div v-else class="resenas-grid">
      <div v-for="r in resenas" :key="r.id" class="card resena-card">
        <div class="stars">{{ '★'.repeat(r.valoracion ?? r.calificacion ?? 0) }}{{ '☆'.repeat(5 - (r.valoracion ?? r.calificacion ?? 0)) }}</div>
        <p class="comentario">"{{ r.comentario }}"</p>
        <div class="resena-footer">
          <div class="avatar">{{ (r.usuario?.nombre || 'A').charAt(0).toUpperCase() }}</div>
          <div>
            <div class="autor">{{ r.usuario?.nombre || 'Anónimo' }}</div>
            <div class="fecha">{{ r.fecha ? new Date(r.fecha).toLocaleDateString('es-ES') : '' }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario — solo si está autenticado -->
    <div v-if="auth.isAuthenticated" class="form-card card">
      <h2>Deja tu reseña</h2>
      <div v-if="exito" class="alert alert-success">¡Reseña publicada!</div>
      <form v-else @submit.prevent="publicar">
        <div class="form-group">
          <label>Calificación</label>
          <div class="stars-select">
            <label v-for="n in [5,4,3,2,1]" :key="n" :class="['star-opt', { active: form.calificacion === n }]">
              <input type="radio" :value="n" v-model="form.calificacion" />
              {{ '★'.repeat(n) }}
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Comentario</label>
          <textarea v-model="form.comentario" rows="3" required placeholder="Cuéntanos tu experiencia..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="saving">
          {{ saving ? '…' : 'Publicar Reseña' }}
        </button>
      </form>
    </div>
    <div v-else class="login-cta">
      ¿Quieres dejar una reseña?
      <RouterLink to="/login" class="btn btn-primary btn-sm" style="margin-left:.75rem">Inicia sesión</RouterLink>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useAuthStore } from '../stores/auth'
import { getResenas, crearResena } from '../api/resenas'

const auth = useAuthStore()
const resenas = ref([])
const loading = ref(true)
const saving = ref(false)
const exito = ref(false)
const form = reactive({ calificacion: 5, comentario: '' })

onMounted(async () => {
  try {
    const { data } = await getResenas()
    resenas.value = data
  } finally {
    loading.value = false
  }
})

async function publicar() {
  saving.value = true
  try {
    const { data } = await crearResena(form.calificacion, form.comentario)
    resenas.value.unshift(data)
    exito.value = true
  } finally {
    saving.value = false
  }
}
</script>

<style scoped>
.resenas-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2.5rem;
}
.resena-card { display: flex; flex-direction: column; gap: .5rem; }
.stars { font-size: 1.15rem; color: #f59e0b; }
.comentario { font-style: italic; color: var(--muted); font-size: .95rem; flex: 1; }
.resena-footer { display: flex; align-items: center; gap: .75rem; margin-top: .25rem; }
.avatar {
  width: 2.4rem; height: 2.4rem; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), #7c3aed);
  color: #fff; display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: .85rem; flex-shrink: 0;
}
.autor { font-weight: 600; font-size: .9rem; }
.fecha { font-size: .75rem; color: var(--muted); }

.form-card { max-width: 560px; margin: 0 auto 2rem; }
.form-card h2 { font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; }
.stars-select { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: .5rem; }
.star-opt { cursor: pointer; font-size: 1.1rem; color: var(--muted); transition: color .15s; }
.star-opt.active, .star-opt:hover { color: #f59e0b; }
.star-opt input { display: none; }

.login-cta { text-align: center; padding: 2rem; color: var(--muted); }
</style>
