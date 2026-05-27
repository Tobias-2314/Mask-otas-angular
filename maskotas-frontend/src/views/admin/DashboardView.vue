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
      <h1>Panel de administración</h1>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else>
      <div class="stats-grid">
        <div class="stat-card card">
          <div class="stat-value">{{ stats.totalUsuarios }}</div>
          <div class="stat-label">Usuarios</div>
        </div>
        <div class="stat-card card">
          <div class="stat-value">{{ stats.totalCitas }}</div>
          <div class="stat-label">Citas totales</div>
        </div>
        <div class="stat-card card">
          <div class="stat-value">{{ stats.citasPendientes }}</div>
          <div class="stat-label">Citas pendientes</div>
        </div>
        <div class="stat-card card">
          <div class="stat-value">{{ stats.totalResenas }}</div>
          <div class="stat-label">Reseñas</div>
        </div>
      </div>

      <div class="card">
        <h2 class="section-head">Ventas recientes</h2>
        <div v-if="!stats.sales?.length" class="loading">Sin ventas en el período.</div>
        <table v-else class="table">
          <thead><tr><th>Fecha</th><th>Total</th></tr></thead>
          <tbody>
            <tr v-for="(s, i) in stats.sales" :key="i">
              <td>{{ s.date }}</td>
              <td>${{ s.total?.toFixed(2) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getDashboard } from '../../api/admin'

const stats = ref({})
const loading = ref(true)

onMounted(async () => {
  const { data } = await getDashboard()
  stats.value = data
  loading.value = false
})
</script>
