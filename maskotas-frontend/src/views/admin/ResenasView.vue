<template>
  <div class="container" style="padding-top:2rem">
    <div class="admin-nav">
      <RouterLink to="/admin/dashboard" class="admin-link">Dashboard</RouterLink>
      <RouterLink to="/admin/productos" class="admin-link">Productos</RouterLink>
      <RouterLink to="/admin/usuarios" class="admin-link">Usuarios</RouterLink>
      <RouterLink to="/admin/citas" class="admin-link">Citas</RouterLink>
      <RouterLink to="/admin/mascotas" class="admin-link">Mascotas</RouterLink>
      <RouterLink to="/admin/resenas" class="admin-link">Reseñas</RouterLink>
    </div>

    <div class="page-header">
      <h1>Reseñas</h1>
      <span v-if="!loading" style="color:var(--muted);font-size:.9rem">{{ resenas.length }} en total</span>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="resenas.length === 0" class="loading">No hay reseñas registradas.</div>
    <div v-else class="resenas-grid">
      <div v-for="r in resenas" :key="r.id" class="card resena-card">
        <div class="resena-header">
          <div class="avatar">{{ (r.usuario?.nombre || 'U').charAt(0).toUpperCase() }}</div>
          <div>
            <div class="autor">{{ r.usuario?.nombre || 'Usuario' }}</div>
            <div class="fecha">{{ r.fecha ? new Date(r.fecha).toLocaleDateString('es-ES') : '—' }}</div>
          </div>
          <div class="stars">{{ '★'.repeat(r.valoracion ?? r.calificacion ?? 0) }}</div>
        </div>
        <p class="comentario">{{ r.comentario }}</p>
        <div class="resena-actions">
          <button class="btn btn-danger btn-sm" @click="eliminar(r.id)" :disabled="eliminando === r.id">
            {{ eliminando === r.id ? '…' : 'Eliminar' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getResenas, eliminarResena } from '../../api/admin'

const resenas = ref([])
const loading = ref(true)
const eliminando = ref(null)

onMounted(async () => {
  try {
    const { data } = await getResenas()
    resenas.value = data
  } finally {
    loading.value = false
  }
})

async function eliminar(id) {
  if (!confirm('¿Eliminar esta reseña?')) return
  eliminando.value = id
  try {
    await eliminarResena(id)
    resenas.value = resenas.value.filter(r => r.id !== id)
  } finally {
    eliminando.value = null
  }
}
</script>

<style scoped>
.resenas-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.25rem;
}
.resena-card { display: flex; flex-direction: column; gap: .75rem; }
.resena-header { display: flex; align-items: center; gap: .75rem; }
.avatar {
  width: 2.5rem; height: 2.5rem; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), #7c3aed);
  color: #fff; display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: .9rem; flex-shrink: 0;
}
.autor { font-weight: 600; font-size: .9rem; }
.fecha { font-size: .75rem; color: var(--muted); }
.stars { margin-left: auto; color: #f59e0b; font-size: 1rem; }
.comentario { color: var(--muted); font-size: .9rem; flex: 1; }
.resena-actions { border-top: 1px solid var(--border); padding-top: .75rem; }
.resena-actions .btn { width: 100%; }
</style>
