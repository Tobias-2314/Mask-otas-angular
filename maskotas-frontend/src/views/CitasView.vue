<template>
  <div class="container" style="max-width:900px;padding-top:2rem">
    <div class="page-header">
      <h1>Mis citas</h1>
      <button class="btn btn-primary" @click="showForm = !showForm">
        {{ showForm ? 'Cancelar' : '+ Nueva cita' }}
      </button>
    </div>

    <div v-if="showForm" class="card" style="margin-bottom:1.5rem">
      <h2 style="margin-bottom:1rem;font-size:1.1rem">Agendar nueva cita</h2>
      <form @submit.prevent="guardar">
        <div class="form-row">
          <div class="form-group">
            <label>Tipo de servicio</label>
            <select v-model="form.tipoServicio" required>
              <option value="consulta">Consulta</option>
              <option value="vacunacion">Vacunación</option>
              <option value="peluqueria">Peluquería</option>
              <option value="cirugia">Cirugía</option>
            </select>
          </div>
          <div class="form-group">
            <label>Mascota (nombre)</label>
            <input type="text" v-model="form.nombreMascota" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Fecha</label>
            <input type="date" v-model="form.fechaPreferida" :min="today" required />
          </div>
          <div class="form-group">
            <label>Hora</label>
            <select v-model="form.horaPreferida" required>
              <option v-for="h in horas" :key="h" :value="h" :disabled="ocupadas.includes(form.fechaPreferida + 'T' + h)">
                {{ h }}{{ ocupadas.includes(form.fechaPreferida + 'T' + h) ? ' (ocupada)' : '' }}
              </option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Notas adicionales</label>
          <textarea v-model="form.notas" rows="2"></textarea>
        </div>
        <div v-if="formError" class="alert alert-error">{{ formError }}</div>
        <div v-if="formSuccess" class="alert alert-success">{{ formSuccess }}</div>
        <button type="submit" class="btn btn-primary" :disabled="saving">
          {{ saving ? 'Guardando…' : 'Agendar cita' }}
        </button>
      </form>
    </div>

    <div v-if="loading" class="loading">Cargando citas…</div>
    <div v-else-if="citas.length === 0" class="loading">No tienes citas registradas.</div>
    <div v-else class="card" style="padding:0;overflow:hidden">
      <table class="table">
        <thead>
          <tr><th>Fecha</th><th>Hora</th><th>Tipo</th><th>Mascota</th><th>Estado</th><th></th></tr>
        </thead>
        <tbody>
          <tr v-for="c in citas" :key="c.id">
            <td>{{ c.fechaPreferida }}</td>
            <td>{{ c.horaPreferida }}</td>
            <td>{{ c.tipo }}</td>
            <td>{{ c.mascota }}</td>
            <td><span :class="['badge', estadoBadge(c.estado)]">{{ c.estado }}</span></td>
            <td>
              <button class="btn btn-danger btn-sm" @click="eliminar(c.id)">✕</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getMisCitas, crearCita, eliminarCita, getOcupadas } from '../api/citas'

const citas = ref([])
const loading = ref(true)
const showForm = ref(false)
const saving = ref(false)
const formError = ref('')
const formSuccess = ref('')
const ocupadas = ref([])
const today = new Date().toISOString().split('T')[0]

const horas = ['09:00','10:00','11:00','12:00','14:00','15:00','16:00','17:00']

const form = ref({ tipoServicio: 'consulta', nombreMascota: '', fechaPreferida: today, horaPreferida: '09:00', notas: '' })

function estadoBadge(estado) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[estado] || 'badge-gray'
}

async function cargar() {
  loading.value = true
  try {
    const [citasRes, ocupadasRes] = await Promise.all([getMisCitas(), getOcupadas()])
    citas.value = citasRes.data
    ocupadas.value = ocupadasRes.data.map(o => `${o.fechaPreferida}T${o.horaPreferida}`)
  } finally {
    loading.value = false
  }
}

async function guardar() {
  formError.value = ''
  formSuccess.value = ''
  saving.value = true
  try {
    await crearCita(form.value)
    formSuccess.value = 'Cita agendada correctamente'
    showForm.value = false
    await cargar()
  } catch (e) {
    formError.value = e.response?.data?.error || 'Error al agendar cita'
  } finally {
    saving.value = false
  }
}

async function eliminar(id) {
  if (!confirm('¿Eliminar esta cita?')) return
  await eliminarCita(id)
  await cargar()
}

onMounted(cargar)
</script>

<style scoped>
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
@media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
</style>
