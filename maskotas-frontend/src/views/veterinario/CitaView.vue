<template>
  <div class="container" style="max-width:700px;padding-top:2rem">
    <RouterLink to="/veterinario/dashboard" class="btn btn-outline btn-sm" style="margin-bottom:1.5rem">← Volver</RouterLink>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="!cita" class="loading">Cita no encontrada.</div>
    <div v-else>
      <div class="page-header">
        <h1>Cita #{{ cita.id }}</h1>
      </div>

      <div class="card info-grid">
        <div><label>Dueño</label><p>{{ cita.nombreDueno }}</p></div>
        <div><label>Email</label><p>{{ cita.email }}</p></div>
        <div><label>Teléfono</label><p>{{ cita.telefono }}</p></div>
        <div><label>Mascota</label><p>{{ cita.nombreMascota }} ({{ cita.tipoMascota }})</p></div>
        <div><label>Servicio</label><p>{{ cita.tipoServicio }}</p></div>
        <div>
          <label>Estado</label>
          <span :class="['badge', estadoBadge(cita.estado)]">{{ cita.estado }}</span>
        </div>
        <div><label>Fecha</label><p>{{ cita.fechaPreferida }} {{ cita.horaPreferida }}</p></div>
      </div>

      <div class="card" style="margin-top:1.25rem">
        <h2 style="font-size:1rem;font-weight:700;margin-bottom:1rem">Historial clínico</h2>
        <form @submit.prevent="guardar">
          <div class="form-group">
            <label>Estado</label>
            <select v-model="form.estado">
              <option value="PENDIENTE">PENDIENTE</option>
              <option value="CONFIRMADA">CONFIRMADA</option>
              <option value="CANCELADA">CANCELADA</option>
              <option value="COMPLETADA">COMPLETADA</option>
            </select>
          </div>
          <div class="form-group"><label>Diagnóstico</label><textarea v-model="form.diagnostico" rows="2"></textarea></div>
          <div class="form-group"><label>Tratamiento</label><textarea v-model="form.tratamiento" rows="2"></textarea></div>
          <div class="form-group"><label>Notas internas</label><textarea v-model="form.notasInternas" rows="2"></textarea></div>
          <div v-if="msg" :class="['alert', ok ? 'alert-success' : 'alert-error']">{{ msg }}</div>
          <button type="submit" class="btn btn-primary" :disabled="saving">{{ saving ? 'Guardando…' : 'Guardar' }}</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { getCita, actualizarCita } from '../../api/veterinario'

const route = useRoute()
const cita = ref(null)
const loading = ref(true)
const saving = ref(false)
const msg = ref('')
const ok = ref(false)
const form = ref({ estado: '', diagnostico: '', tratamiento: '', notasInternas: '' })

function estadoBadge(e) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[e] || 'badge-gray'
}

onMounted(async () => {
  const { data } = await getCita(route.params.id)
  cita.value = data
  form.value = {
    estado: data.estado || 'PENDIENTE',
    diagnostico: data.diagnostico || '',
    tratamiento: data.tratamiento || '',
    notasInternas: data.notasInternas || ''
  }
  loading.value = false
})

async function guardar() {
  saving.value = true
  msg.value = ''
  try {
    await actualizarCita(route.params.id, form.value)
    msg.value = 'Historial clínico actualizado'
    ok.value = true
    const { data } = await getCita(route.params.id)
    cita.value = data
  } catch (e) {
    msg.value = e.response?.data?.error || 'Error'
    ok.value = false
  } finally {
    saving.value = false
  }
}
</script>

<style scoped>
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem 1.5rem; }
.info-grid label { font-size: .75rem; font-weight: 600; color: var(--muted); text-transform: uppercase; }
.info-grid p { margin-top: .15rem; font-size: .95rem; }
@media (max-width: 500px) { .info-grid { grid-template-columns: 1fr; } }
</style>
