<template>
  <div class="container" style="padding-top:2rem">
    <div class="page-header">
      <h1>Panel Veterinario</h1>
      <p>Citas pendientes y confirmadas</p>
    </div>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="citas.length === 0" class="loading">No hay citas asignadas.</div>
    <div v-else class="card" style="padding:0;overflow:hidden">
      <table class="table">
        <thead><tr><th>Fecha</th><th>Hora</th><th>Dueño</th><th>Mascota</th><th>Tipo</th><th>Estado</th><th></th></tr></thead>
        <tbody>
          <tr v-for="c in citas" :key="c.id">
            <td>{{ c.fechaPreferida }}</td>
            <td>{{ c.horaPreferida }}</td>
            <td>{{ c.nombreDueno }}</td>
            <td>{{ c.nombreMascota }}</td>
            <td>{{ c.tipo }}</td>
            <td><span :class="['badge', estadoBadge(c.estado)]">{{ c.estado }}</span></td>
            <td>
              <RouterLink :to="`/veterinario/citas/${c.id}`" class="btn btn-outline btn-sm">Ver</RouterLink>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getDashboard } from '../../api/veterinario'

const citas = ref([])
const loading = ref(true)

function estadoBadge(e) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[e] || 'badge-gray'
}

onMounted(async () => {
  const { data } = await getDashboard()
  citas.value = data
  loading.value = false
})
</script>
