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
      <h1>Mascotas</h1>
    </div>

    <div class="card" style="margin-bottom:1.25rem">
      <form @submit.prevent="buscar" class="search-row">
        <input v-model="search" placeholder="Buscar por nombre o dueño…" />
        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        <button type="button" class="btn btn-outline btn-sm" @click="limpiar">Limpiar</button>
      </form>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>

    <div v-else-if="!selected" class="card table-card">
      <table class="table">
        <thead><tr><th>ID</th><th>Nombre</th><th>Tipo</th><th>Dueño</th><th></th></tr></thead>
        <tbody>
          <tr v-for="m in mascotas" :key="m.id">
            <td>#{{ m.id }}</td>
            <td>{{ m.nombre }}</td>
            <td>{{ m.tipo }}</td>
            <td>{{ m.dueno }}</td>
            <td>
              <button class="btn btn-outline btn-sm" @click="verDetalle(m.id)">Ver historial</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="card">
      <button class="btn btn-outline btn-sm" style="margin-bottom:1.25rem" @click="selected = null">← Volver</button>
      <h2 class="section-head">{{ selected.nombre }} ({{ selected.tipo }})</h2>
      <p style="color:var(--muted);font-size:.9rem;margin-bottom:1.25rem">Dueño: {{ selected.dueno?.nombre }}</p>

      <h3 class="subsection-head">Historial médico</h3>
      <div v-if="!selected.historial?.length" class="loading">Sin registros.</div>
      <table v-else class="table" style="margin-bottom:1.5rem">
        <thead><tr><th>Fecha</th><th>Tipo</th><th>Descripción</th></tr></thead>
        <tbody>
          <tr v-for="h in selected.historial" :key="h.id">
            <td>{{ h.fecha }}</td>
            <td>{{ h.tipo }}</td>
            <td>{{ h.descripcion }}</td>
          </tr>
        </tbody>
      </table>

      <h3 class="subsection-head">Agregar entrada</h3>
      <form @submit.prevent="guardarHistorial">
        <div class="form-row">
          <div class="form-group"><label>Tipo</label><input v-model="hForm.tipo" required /></div>
          <div class="form-group"><label>Fecha</label><input type="date" v-model="hForm.fecha" required /></div>
        </div>
        <div class="form-group"><label>Descripción</label><textarea v-model="hForm.descripcion" rows="2" required></textarea></div>
        <button class="btn btn-primary btn-sm" :disabled="saving">{{ saving ? '…' : 'Guardar' }}</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getMascotas, getMascota, guardarHistorial as apiGuardarHistorial } from '../../api/admin'

const mascotas = ref([])
const loading = ref(true)
const search = ref('')
const selected = ref(null)
const saving = ref(false)
const hForm = ref({ tipo: '', descripcion: '', fecha: new Date().toISOString().split('T')[0] })

async function cargar(q) {
  loading.value = true
  const { data } = await getMascotas(q)
  mascotas.value = data
  loading.value = false
}

function buscar() { cargar(search.value) }
function limpiar() { search.value = ''; cargar() }

async function verDetalle(id) {
  const { data } = await getMascota(id)
  selected.value = data
}

async function guardarHistorial() {
  saving.value = true
  try {
    await apiGuardarHistorial(selected.value.id, hForm.value)
    const { data } = await getMascota(selected.value.id)
    selected.value = data
    hForm.value = { tipo: '', descripcion: '', fecha: new Date().toISOString().split('T')[0] }
  } finally {
    saving.value = false
  }
}

onMounted(() => cargar())
</script>
