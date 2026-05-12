<template>
  <div class="container" style="max-width:900px;padding-top:2rem">
    <div class="page-header">
      <h1>Mis citas</h1>
      <button class="btn btn-primary" @click="toggleForm">
        {{ showForm ? 'Cancelar' : '+ Nueva cita' }}
      </button>
    </div>

    <!-- Formulario -->
    <div v-if="showForm" class="card" style="margin-bottom:1.5rem">
      <h2 style="margin-bottom:1.5rem;font-size:1.15rem;font-weight:800">Agendar nueva cita</h2>
      <form @submit.prevent="guardar">

        <!-- Datos del dueño -->
        <h3 class="section-label">Datos del Dueño</h3>
        <div class="form-row">
          <div class="form-group">
            <label>Nombre completo</label>
            <input v-model="form.nombreDueno" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" v-model="form.email" required />
          </div>
          <div class="form-group">
            <label>Teléfono</label>
            <input v-model="form.telefono" required placeholder="600 123 456" />
          </div>
        </div>

        <!-- Datos de la cita -->
        <h3 class="section-label" style="margin-top:1.5rem">Datos de la Cita</h3>
        <div class="form-row">
          <div class="form-group">
            <label>Mascota registrada</label>
            <select v-model="mascotaId" @change="onMascotaChange">
              <option value="">— Sin seleccionar —</option>
              <option v-for="m in mascotas" :key="m.id" :value="m.id">
                {{ m.nombre }} ({{ m.tipo }})
              </option>
            </select>
            <small v-if="mascotas.length === 0" style="color:var(--muted)">
              Sin mascotas registradas. <RouterLink to="/mi-cuenta">Regístralas aquí</RouterLink>.
            </small>
          </div>
          <div class="form-group">
            <label>Nombre mascota</label>
            <input v-model="form.nombreMascota" required :disabled="!!mascotaId" />
          </div>
          <div class="form-group">
            <label>Tipo de mascota</label>
            <select v-model="form.tipoMascota" :disabled="!!mascotaId">
              <option value="">— Seleccionar —</option>
              <option>Perro</option>
              <option>Gato</option>
              <option>Ave</option>
              <option>Conejo</option>
              <option>Otro</option>
            </select>
          </div>
          <div class="form-group">
            <label>Servicio</label>
            <select v-model="form.tipoServicio" required>
              <option>Consulta General</option>
              <option>Vacunación</option>
              <option>Desparasitación</option>
              <option>Cirugía</option>
              <option>Peluquería</option>
            </select>
          </div>
        </div>

        <!-- Fecha y hora -->
        <h3 class="section-label" style="margin-top:1.5rem">Selecciona Fecha y Hora</h3>
        <div class="form-group" style="max-width:280px">
          <label>Fecha de la cita</label>
          <input type="date" v-model="form.fechaPreferida" :min="today" required @change="form.horaPreferida = ''" />
        </div>

        <template v-if="form.fechaPreferida">
          <div class="slots-label">Horarios disponibles</div>
          <div class="slots-grid">
            <button v-for="h in horas" :key="h" type="button"
              :class="['slot-btn', isOcupada(h) ? 'slot-occupied' : form.horaPreferida === h ? 'slot-selected' : 'slot-free']"
              :disabled="isOcupada(h)"
              @click="form.horaPreferida = h">
              {{ h }}
              <span v-if="isOcupada(h)" class="slot-tag">Ocupado</span>
            </button>
          </div>
          <p v-if="!form.horaPreferida" class="slots-hint">Selecciona un horario disponible para continuar</p>
        </template>

        <div class="form-group" style="margin-top:1.25rem">
          <label>Notas adicionales</label>
          <textarea v-model="form.notas" rows="2" placeholder="Información de salud relevante…"></textarea>
        </div>

        <div v-if="formError" class="alert alert-error">{{ formError }}</div>
        <div v-if="formSuccess" class="alert alert-success">{{ formSuccess }}</div>

        <button type="submit" class="btn btn-primary" :disabled="saving || !form.horaPreferida">
          {{ saving ? 'Guardando…' : (form.horaPreferida ? `Confirmar cita — ${form.fechaPreferida} a las ${form.horaPreferida}` : 'Selecciona un horario') }}
        </button>
      </form>
    </div>

    <!-- Lista de citas -->
    <div v-if="loading" class="loading">Cargando citas…</div>
    <div v-else-if="citas.length === 0" class="loading">No tienes citas registradas.</div>
    <div v-else class="card" style="padding:0;overflow:hidden">
      <table class="table">
        <thead>
          <tr><th>Fecha</th><th>Hora</th><th>Servicio</th><th>Mascota</th><th>Estado</th><th></th></tr>
        </thead>
        <tbody>
          <tr v-for="c in citas" :key="c.id">
            <td>{{ c.fechaPreferida }}</td>
            <td>{{ c.horaPreferida }}</td>
            <td>{{ c.tipo }}</td>
            <td>{{ c.mascota }}</td>
            <td><span :class="['badge', estadoBadge(c.estado)]">{{ c.estado }}</span></td>
            <td>
              <button class="btn btn-danger btn-sm" @click="eliminar(c.id)" :disabled="c.estado === 'COMPLETADA'">✕</button>
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
import { getMascotas } from '../api/mascotas'
import { useAuthStore } from '../stores/auth'

const auth = useAuthStore()

const citas    = ref([])
const mascotas = ref([])
const ocupadas = ref([])
const loading  = ref(true)
const showForm = ref(false)
const saving   = ref(false)
const formError   = ref('')
const formSuccess = ref('')
const mascotaId   = ref('')

const today = new Date().toISOString().split('T')[0]

const horas = [
  '10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30',
  '14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30',
  '18:00','18:30','19:00','19:30','20:00'
]

function emptyForm() {
  return {
    tipoServicio:   'Consulta General',
    nombreMascota:  '',
    tipoMascota:    '',
    fechaPreferida: today,
    horaPreferida:  '',
    notas:          '',
    nombreDueno:    auth.usuario?.nombre || '',
    email:          auth.usuario?.email  || '',
    telefono:       '',
    mascota:        null
  }
}

const form = ref(emptyForm())

function toggleForm() {
  showForm.value = !showForm.value
  if (showForm.value) {
    form.value     = emptyForm()
    mascotaId.value = ''
    formError.value   = ''
    formSuccess.value = ''
  }
}

function isOcupada(hora) {
  return ocupadas.value.some(o => o.fechaPreferida === form.value.fechaPreferida && o.horaPreferida === hora)
}

function onMascotaChange() {
  const m = mascotas.value.find(m => m.id == mascotaId.value)
  if (m) {
    form.value.nombreMascota = m.nombre
    form.value.tipoMascota   = m.tipo
    form.value.mascota       = { id: m.id }
  } else {
    form.value.nombreMascota = ''
    form.value.tipoMascota   = ''
    form.value.mascota       = null
  }
}

function estadoBadge(estado) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[estado] || 'badge-gray'
}

async function cargar() {
  loading.value = true
  try {
    const [citasRes, ocupadasRes, mascotasRes] = await Promise.all([
      getMisCitas(), getOcupadas(), getMascotas()
    ])
    citas.value    = citasRes.data
    ocupadas.value = ocupadasRes.data
    mascotas.value = mascotasRes.data
  } finally {
    loading.value = false
  }
}

async function guardar() {
  formError.value   = ''
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
.section-label {
  font-size: .78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: var(--muted);
  border-bottom: 1px solid var(--border);
  padding-bottom: .5rem;
  margin-bottom: 1rem;
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
@media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }

.slots-label { font-size: .85rem; font-weight: 600; margin-bottom: .6rem; margin-top: .25rem; }
.slots-hint  { font-size: .8rem; color: var(--muted); margin-top: .4rem; }

.slots-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(108px, 1fr));
  gap: .55rem;
}
.slot-btn {
  padding: .65rem .4rem;
  border-radius: 10px;
  font-weight: 700;
  font-size: .9rem;
  border: 2px solid transparent;
  cursor: pointer;
  transition: all .15s;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .15rem;
}
.slot-free     { background: var(--primary); color: #fff; }
.slot-free:hover { filter: brightness(1.12); transform: translateY(-1px); }
.slot-selected { background: #1a3d15; color: #fff; border-color: #f59e0b; box-shadow: 0 0 0 3px #f59e0b40; }
.slot-occupied { background: #f3f4f6; color: #9ca3af; border-color: #e5e7eb; cursor: not-allowed; }
.slot-tag { font-size: .6rem; opacity: .8; font-weight: 400; }
</style>
