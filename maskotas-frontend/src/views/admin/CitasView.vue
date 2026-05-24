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
      <h1>Citas</h1>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else class="card table-card">
      <table class="table">
        <thead><tr><th>ID</th><th>Fecha</th><th>Dueño</th><th>Tipo</th><th>Estado</th><th>Cambiar estado</th></tr></thead>
        <tbody>
          <tr v-for="c in citas" :key="c.id">
            <td>#{{ c.id }}</td>
            <td>{{ c.fechaPreferida }}</td>
            <td>{{ c.nombreDueno || c.usuario }}</td>
            <td>{{ c.tipo }}</td>
            <td><span :class="['badge', estadoBadge(c.estado)]">{{ c.estado }}</span></td>
            <td>
              <select class="estado-select" :value="c.estado" @change="cambiarEstado(c.id, $event.target.value)">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="CONFIRMADA">CONFIRMADA</option>
                <option value="CANCELADA">CANCELADA</option>
                <option value="COMPLETADA">COMPLETADA</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getCitas } from '../../api/admin'
import { actualizarEstado } from '../../api/citas'

const citas = ref([])
const loading = ref(true)

function estadoBadge(e) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[e] || 'badge-gray'
}

async function cargar() {
  const { data } = await getCitas()
  citas.value = data
  loading.value = false
}

async function cambiarEstado(id, estado) {
  await actualizarEstado(id, estado)
  await cargar()
}

onMounted(cargar)
</script>
