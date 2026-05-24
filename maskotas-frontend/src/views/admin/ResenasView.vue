<template>
  <div class="container admin-page">
    <nav class="admin-nav">
      <RouterLink to="/admin/dashboard" class="admin-link">Dashboard</RouterLink>
      <RouterLink to="/admin/productos" class="admin-link">Productos</RouterLink>
      <RouterLink to="/admin/usuarios" class="admin-link">Usuarios</RouterLink>
      <RouterLink to="/admin/citas" class="admin-link">Citas</RouterLink>
      <RouterLink to="/admin/mascotas" class="admin-link">Mascotas</RouterLink>
      <RouterLink to="/admin/resenas" class="admin-link">Reseñas</RouterLink>
    </nav>

    <div class="admin-header">
      <h1>Reseñas</h1>
      <span v-if="!loading">{{ resenas.length }} en total</span>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="resenas.length === 0" class="loading">No hay reseñas registradas.</div>
    <div v-else class="resenas-grid">
      <div v-for="r in resenas" :key="r.id" class="card resena-card">
        <div class="resena-header">
          <div class="resena-avatar">{{ (r.usuario?.nombre || 'U').charAt(0).toUpperCase() }}</div>
          <div>
            <div class="resena-autor">{{ r.usuario?.nombre || 'Usuario' }}</div>
            <div class="resena-fecha">{{ r.fecha ? new Date(r.fecha).toLocaleDateString('es-ES') : '—' }}</div>
          </div>
          <div class="resena-stars">{{ '★'.repeat(r.valoracion ?? r.calificacion ?? 0) }}</div>
        </div>
        <p class="resena-comentario">{{ r.comentario }}</p>
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
