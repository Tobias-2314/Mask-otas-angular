<template>
  <div class="container" style="max-width:960px;padding-top:2rem">
    <RouterLink to="/veterinario/dashboard" class="btn btn-outline btn-sm" style="margin-bottom:1.5rem">← Volver</RouterLink>

    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else-if="!cita" class="loading">Cita no encontrada.</div>
    <div v-else>
      <div class="page-header" style="margin-bottom:1.25rem">
        <h1>Cita #{{ cita.id }}</h1>
        <span :class="['badge', estadoBadge(cita.estado)]" style="font-size:.9rem;padding:.35rem .85rem">{{ cita.estado }}</span>
      </div>

      <div class="layout-grid">
        <!-- Left column: owner + patient info -->
        <div class="left-col">
          <!-- Owner card -->
          <div class="card info-card">
            <div class="card-title">Datos del dueño</div>
            <div class="info-row"><span class="info-label">Nombre</span><span>{{ cita.nombreDueno }}</span></div>
            <div class="info-row"><span class="info-label">Email</span><span>{{ cita.email }}</span></div>
            <div class="info-row"><span class="info-label">Teléfono</span><span>{{ cita.telefono || '—' }}</span></div>
          </div>

          <!-- Appointment card -->
          <div class="card info-card" style="margin-top:1rem">
            <div class="card-title">Datos de la cita</div>
            <div class="info-row"><span class="info-label">Servicio</span><span>{{ cita.tipoServicio }}</span></div>
            <div class="info-row"><span class="info-label">Fecha</span><span>{{ cita.fechaPreferida }}</span></div>
            <div class="info-row"><span class="info-label">Hora</span><span>{{ cita.horaPreferida }}</span></div>
          </div>

          <!-- Pet card -->
          <div class="card info-card" style="margin-top:1rem">
            <div class="card-title">Paciente</div>
            <div class="pet-header">
              <div class="pet-icon">🐾</div>
              <div>
                <div class="pet-name">{{ cita.nombreMascota }}</div>
                <div class="pet-type">{{ cita.tipoMascota }}</div>
              </div>
            </div>
            <div v-if="cita.mascota" class="pet-details">
              <div class="info-row" v-if="cita.mascota.raza"><span class="info-label">Raza</span><span>{{ cita.mascota.raza }}</span></div>
              <div class="info-row" v-if="cita.mascota.genero"><span class="info-label">Género</span><span>{{ cita.mascota.genero }}</span></div>
              <div class="info-row" v-if="cita.mascota.edad != null"><span class="info-label">Edad</span><span>{{ cita.mascota.edad }} años</span></div>
              <div class="info-row" v-if="cita.mascota.peso != null"><span class="info-label">Peso</span><span>{{ cita.mascota.peso }} kg</span></div>
            </div>
            <div v-if="cita.mascota?.notasMedicas" class="alert alert-error" style="margin-top:.75rem;font-size:.85rem">
              <strong>⚠ Notas médicas / Alergias:</strong><br/>{{ cita.mascota.notasMedicas }}
            </div>
            <div v-if="!cita.mascota" class="muted-text" style="margin-top:.5rem;font-size:.85rem">Mascota no vinculada al sistema</div>
          </div>
        </div>

        <!-- Right column: clinical history form -->
        <div class="right-col">
          <div class="card">
            <div class="card-title" style="margin-bottom:1rem">Historial clínico</div>
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
              <div class="form-group">
                <label>Diagnóstico</label>
                <textarea v-model="form.diagnostico" rows="4" placeholder="Escribe el diagnóstico…"></textarea>
              </div>
              <div class="form-group">
                <label>Tratamiento / Receta</label>
                <textarea v-model="form.tratamiento" rows="4" placeholder="Medicación, dosis, instrucciones…"></textarea>
              </div>
              <div class="form-group">
                <label>Notas internas</label>
                <textarea v-model="form.notasInternas" rows="3" placeholder="Notas visibles solo para veterinarios…"></textarea>
              </div>
              <div v-if="msg" :class="['alert', ok ? 'alert-success' : 'alert-error']">{{ msg }}</div>
              <button type="submit" class="btn btn-primary" :disabled="saving" style="width:100%">
                {{ saving ? 'Guardando…' : 'Guardar historial clínico' }}
              </button>
            </form>
          </div>
        </div>
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
.layout-grid {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 1.25rem;
  align-items: start;
}
@media (max-width: 720px) {
  .layout-grid { grid-template-columns: 1fr; }
}

.info-card { padding: 1rem 1.25rem; }
.card-title { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: .75rem; border-bottom: 1px solid var(--border); padding-bottom: .5rem; }
.info-row { display: flex; justify-content: space-between; align-items: baseline; gap: .5rem; padding: .3rem 0; font-size: .9rem; border-bottom: 1px solid #f3f4f6; }
.info-row:last-child { border-bottom: none; }
.info-label { font-size: .78rem; font-weight: 600; color: var(--muted); flex-shrink: 0; }

.pet-header { display: flex; align-items: center; gap: .75rem; margin-bottom: .75rem; }
.pet-icon { font-size: 1.8rem; }
.pet-name { font-weight: 700; font-size: 1.05rem; }
.pet-type { font-size: .85rem; color: var(--muted); }
.pet-details { border-top: 1px solid var(--border); padding-top: .5rem; }

.muted-text { color: var(--muted); }
</style>
