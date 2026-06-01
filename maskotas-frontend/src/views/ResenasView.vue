<template>
  <div>
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Testimonios</span>
        <h1>Lo que dicen<br><em>nuestros clientes</em></h1>
        <p>Nuestra mejor garantía es la satisfacción de nuestras mascotas y sus dueños.</p>
      </div>
    </section>

    <section class="resenas-section">
      <div class="container">
        <div v-if="loading" class="loading">Cargando reseñas…</div>
        <div v-else-if="resenas.length === 0" class="empty-state">
          <p>Aún no hay reseñas. ¡Sé el primero!</p>
        </div>
        <div v-else class="resenas-grid">
          <div v-for="(r, i) in resenas" :key="r.id" :class="['resena-card', `fade-up-${(i % 5) + 1}`]">
            <div class="resena-top">
              <div class="resena-stars">
                <span v-for="n in 5" :key="n" :class="['star', { filled: n <= (r.valoracion ?? r.calificacion ?? 0) }]">★</span>
              </div>
              <div class="resena-num">{{ (r.valoracion ?? r.calificacion ?? 0) }}/5</div>
            </div>
            <blockquote class="resena-text">"{{ r.comentario }}"</blockquote>
            <div class="resena-footer">
              <div class="resena-avatar">{{ (r.usuario?.nombre || 'A').charAt(0).toUpperCase() }}</div>
              <div class="resena-meta">
                <span class="resena-autor">{{ r.usuario?.nombre || 'Anónimo' }}</span>
                <span class="resena-fecha" v-if="r.fecha">{{ new Date(r.fecha).toLocaleDateString('es-ES', { day:'numeric', month:'long', year:'numeric' }) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Formulario nueva reseña -->
    <section class="nueva-resena-section">
      <div class="container">
        <div v-if="auth.isAuthenticated" class="resena-form-card card">
          <div class="form-intro">
            <h2>Comparte tu experiencia</h2>
            <p>Tu opinión ayuda a otros dueños a confiar en nosotros.</p>
          </div>

          <div v-if="exito" class="alert alert-success" style="font-size:1rem">
            ¡Gracias por tu reseña! Tu opinión ha sido publicada.
          </div>
          <form v-else @submit.prevent="publicar" class="resena-form">
            <div class="stars-picker-group">
              <label>Calificación</label>
              <div class="stars-picker">
                <button type="button"
                  v-for="n in 5" :key="n"
                  :class="['star-pick', { selected: form.calificacion >= n }]"
                  @click="form.calificacion = n"
                  :title="`${n} estrellas`"
                >★</button>
              </div>
            </div>
            <div class="form-group">
              <label>Comentario</label>
              <textarea v-model="form.comentario" rows="4" required placeholder="Cuéntanos tu experiencia con Maskotas…"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" :disabled="saving">
              {{ saving ? 'Publicando…' : 'Publicar Reseña' }}
            </button>
          </form>
        </div>
        <div v-else class="login-cta">
          <div class="login-cta-text">
            <h3>¿Quieres compartir tu experiencia?</h3>
            <p>Inicia sesión para dejar tu reseña</p>
          </div>
          <RouterLink to="/login" class="btn btn-primary">Iniciar sesión</RouterLink>
        </div>
      </div>
    </section>
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
    await crearResena(form.calificacion, form.comentario)
    const { data } = await getResenas()
    resenas.value = data
    exito.value = true
  } finally {
    saving.value = false
  }
}
</script>

<style scoped>
.page-hero {
  background: var(--deep);
  color: var(--cream);
  padding: 4.5rem 0 3.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 80%, rgba(26,61,31,.6) 0%, transparent 65%);
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
  margin-bottom: 0.65rem;
}
.page-hero h1 { font-size: clamp(2rem, 4.5vw, 3.5rem); font-weight: 600; color: var(--cream); margin-bottom: 1rem; }
.page-hero h1 em { font-style: italic; color: var(--gold-light); }
.page-hero p { color: rgba(250,246,238,.65); max-width: 480px; margin: 0 auto; font-size: 0.97rem; line-height: 1.7; }

.resenas-section { padding: 4rem 0 3rem; background: var(--cream); }

.empty-state {
  text-align: center;
  padding: 4rem;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.3rem;
  font-style: italic;
  color: var(--text-muted);
}

.resenas-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.25rem;
}
.resena-card {
  background: #fff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  transition: transform 0.22s, box-shadow 0.22s;
}
.resena-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); }

.resena-top { display: flex; align-items: center; justify-content: space-between; }
.resena-stars { display: flex; gap: 2px; }
.star { font-size: 1rem; color: var(--border); }
.star.filled { color: var(--gold); }
.resena-num {
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--text-muted);
  letter-spacing: 0.03em;
}

.resena-text {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.05rem;
  font-style: italic;
  color: var(--text);
  line-height: 1.65;
  flex: 1;
}

.resena-footer { display: flex; align-items: center; gap: 0.7rem; }
.resena-avatar {
  width: 34px; height: 34px;
  border-radius: 50%;
  background: var(--forest);
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 0.82rem;
  flex-shrink: 0;
}
.resena-meta { display: flex; flex-direction: column; gap: 0.1rem; }
.resena-autor { font-size: 0.85rem; font-weight: 700; color: var(--text); }
.resena-fecha { font-size: 0.74rem; color: var(--text-muted); }

.nueva-resena-section { padding: 0 0 5rem; background: var(--cream); }

.resena-form-card { max-width: 600px; margin: 0 auto; }
.form-intro { margin-bottom: 1.75rem; }
.form-intro h2 { font-size: 1.8rem; font-weight: 600; color: var(--deep); margin-bottom: 0.4rem; }
.form-intro p { font-size: 0.9rem; color: var(--text-muted); }

.resena-form { display: flex; flex-direction: column; gap: 0; }
.stars-picker-group {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
  margin-bottom: 1rem;
}
.stars-picker-group > label {
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.08em;
}
.stars-picker { display: flex; gap: 0.25rem; }
.star-pick {
  font-size: 1.8rem;
  color: var(--border);
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  line-height: 1;
  transition: color 0.15s, transform 0.15s;
}
.star-pick:hover,
.star-pick.selected { color: var(--gold); }
.star-pick:hover { transform: scale(1.15); }

.login-cta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1.5rem;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 2rem 2.5rem;
  max-width: 600px;
  margin: 0 auto;
  flex-wrap: wrap;
}
.login-cta-text h3 { font-size: 1.3rem; font-weight: 600; color: var(--deep); margin-bottom: 0.2rem; }
.login-cta-text p { font-size: 0.88rem; color: var(--text-muted); }
</style>
