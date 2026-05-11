<template>
  <div class="container" style="padding-top:2rem">
    <div class="page-header">
      <h1>Panel de administración</h1>
    </div>

    <div class="admin-nav">
      <RouterLink to="/admin/dashboard" class="admin-link">Dashboard</RouterLink>
      <RouterLink to="/admin/productos" class="admin-link">Productos</RouterLink>
      <RouterLink to="/admin/usuarios" class="admin-link">Usuarios</RouterLink>
      <RouterLink to="/admin/citas" class="admin-link">Citas</RouterLink>
      <RouterLink to="/admin/mascotas" class="admin-link">Mascotas</RouterLink>
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

      <div class="card" style="margin-top:1.5rem">
        <h2 class="section-head">Ventas recientes</h2>
        <div v-if="stats.sales?.length === 0" class="muted">Sin ventas en el período.</div>
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

<style scoped>
.admin-nav { display: flex; gap: .75rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
.admin-link { padding: .4rem .9rem; border-radius: 8px; font-size: .85rem; font-weight: 600; background: var(--card); border: 1.5px solid var(--border); color: var(--text); transition: background .15s; }
.admin-link:hover, .admin-link.router-link-active { background: var(--primary); color: #fff; border-color: var(--primary); }
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.25rem; }
.stat-card { text-align: center; padding: 1.5rem; }
.stat-value { font-size: 2.5rem; font-weight: 800; color: var(--primary); }
.stat-label { font-size: .85rem; color: var(--muted); margin-top: .25rem; }
.section-head { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); }
.muted { color: var(--muted); font-size: .9rem; }
</style>
