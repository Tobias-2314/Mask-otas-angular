<template>
  <div class="container cuenta-container">
    <div v-if="loading" class="loading">Cargando…</div>
    <div v-else>
      <div class="page-header">
        <h1>Mi cuenta</h1>
        <p>Bienvenido, {{ data.usuario?.nombre }}</p>
      </div>

      <div class="grid-2">
        <!-- Perfil -->
        <div class="card">
          <h2 class="section-head">Perfil</h2>
          <form @submit.prevent="guardarPerfil">
            <div class="form-group">
              <label for="perfil-nombre">Nombre</label>
              <input id="perfil-nombre" v-model="perfil.nombre" required autocomplete="name" />
            </div>
            <div class="form-group">
              <label for="perfil-email">Email</label>
              <input id="perfil-email" type="email" v-model="perfil.email" required autocomplete="email" />
            </div>
            <div v-if="perfilMsg" :class="['alert', perfilOk ? 'alert-success' : 'alert-error']" role="alert" aria-live="polite">{{ perfilMsg }}</div>
            <button class="btn btn-primary btn-sm" type="submit">Guardar cambios de perfil</button>
          </form>
        </div>

        <!-- Preferencias -->
        <div class="card">
          <h2 class="section-head">Preferencias</h2>
          <form @submit.prevent="guardarPrefs">
            <div class="form-group">
              <label>Tema</label>
              <select v-model="prefs.theme">
                <option value="light">Claro</option>
                <option value="dark">Oscuro</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tamaño de fuente</label>
              <select v-model="prefs.font_size">
                <option value="small">Pequeño</option>
                <option value="medium">Mediano</option>
                <option value="large">Grande</option>
              </select>
            </div>
            <div v-if="prefsMsg" :class="['alert', prefsOk ? 'alert-success' : 'alert-error']" role="alert" aria-live="polite">{{ prefsMsg }}</div>
            <button class="btn btn-primary btn-sm" type="submit">Guardar preferencias</button>
          </form>
        </div>
      </div>

      <!-- Mascotas -->
      <div class="card card-mt">
        <h2 class="section-head">Mis mascotas</h2>
        <div v-if="data.mascotas?.length === 0" class="muted-text muted-mb">Sin mascotas registradas.</div>
        <div v-else class="mascotas-grid">
          <div v-for="m in data.mascotas" :key="m.id" class="mascota-card">
            <!-- aria-hidden en el emoji decorativo -->
            <div class="mascota-icon" aria-hidden="true">🐾</div>
            <div class="mascota-info">
              <div class="mascota-nombre">{{ m.nombre }}</div>
              <div class="muted-text">{{ m.tipo }}<span v-if="m.raza"> · {{ m.raza }}</span></div>
              <div v-if="m.edad" class="muted-text">{{ m.edad }} años<span v-if="m.genero"> · {{ m.genero }}</span></div>
            </div>
            <button class="btn btn-danger btn-sm" @click="eliminarMascota(m.id)" :aria-label="`Eliminar mascota ${m.nombre}`">✕</button>
          </div>
        </div>
        <button class="btn btn-outline btn-sm btn-mt" @click="showMascotaForm = !showMascotaForm" :aria-expanded="showMascotaForm">
          {{ showMascotaForm ? 'Cancelar' : '+ Agregar mascota' }}
        </button>
        <form v-if="showMascotaForm" @submit.prevent="agregarMascota" class="mascota-form">
          <div class="form-row2">
            <div class="form-group"><label>Nombre *</label><input v-model="nuevaMascota.nombre" required /></div>
            <div class="form-group">
              <label>Tipo *</label>
              <select v-model="nuevaMascota.tipo" required>
                <option value="">Seleccionar…</option>
                <option>Perro</option><option>Gato</option><option>Ave</option><option>Conejo</option><option>Otro</option>
              </select>
            </div>
          </div>
          <div class="form-row2">
            <div class="form-group"><label>Raza</label><input v-model="nuevaMascota.raza" placeholder="Opcional" /></div>
            <div class="form-group">
              <label>Género</label>
              <select v-model="nuevaMascota.genero">
                <option value="">Desconocido</option><option>Macho</option><option>Hembra</option>
              </select>
            </div>
          </div>
          <div class="form-row2">
            <div class="form-group"><label>Edad (años)</label><input v-model.number="nuevaMascota.edad" type="number" min="0" /></div>
            <div class="form-group"><label>Peso (kg)</label><input v-model.number="nuevaMascota.peso" type="number" step="0.1" min="0" /></div>
          </div>
          <div class="form-group"><label>Notas médicas / Alergias</label><textarea v-model="nuevaMascota.notasMedicas" rows="2"></textarea></div>
          <div v-if="mascotaError" class="alert alert-error" role="alert" aria-live="assertive">{{ mascotaError }}</div>
          <button class="btn btn-primary btn-sm" type="submit">Registrar mascota</button>
        </form>
      </div>

      <!-- Citas -->
      <div class="card card-mt">
        <h2 class="section-head">Mis citas</h2>
        <div v-if="data.citas?.length === 0" class="muted-text">Sin citas.</div>
        <table v-else class="table">
          <thead><tr>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Servicio</th>
            <th scope="col">Estado</th>
            <th scope="col"><span class="sr-only">Acciones</span></th>
          </tr></thead>
          <tbody>
            <tr v-for="c in data.citas" :key="c.id">
              <td>{{ c.fechaPreferida }}</td>
              <td>{{ c.horaPreferida }}</td>
              <td>{{ c.tipo }}</td>
              <td><span :class="['badge', estadoBadge(c.estado)]">{{ c.estado }}</span></td>
              <td>
                <button v-if="c.estado === 'COMPLETADA'" class="btn btn-outline btn-sm" @click="verInforme(c)">
                  Ver Informe
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pedidos -->
      <div class="card card-mt">
        <h2 class="section-head">Mis pedidos</h2>
        <div v-if="data.orders?.length === 0" class="muted-text">Sin pedidos.</div>
        <table v-else class="table">
          <thead><tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
          </tr></thead>
          <tbody>
            <tr v-for="o in data.orders" :key="o.id">
              <td>#{{ o.id }}</td>
              <td>{{ o.fecha?.split('T')[0] }}</td>
              <td>${{ o.total?.toFixed(2) }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Reseña -->
      <div class="card card-mt">
        <h2 class="section-head">Dejar una reseña</h2>
        <form @submit.prevent="publicarResena">
          <div class="form-group">
            <label for="resena-calificacion">Calificación</label>
            <select id="resena-calificacion" v-model="resena.calificacion">
              <option v-for="n in 5" :key="n" :value="n">{{ '★'.repeat(n) }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="resena-comentario">Comentario</label>
            <textarea id="resena-comentario" v-model="resena.comentario" rows="3" required></textarea>
          </div>
          <div v-if="resenaMsg" :class="['alert', resenaOk ? 'alert-success' : 'alert-error']" role="alert" aria-live="polite">{{ resenaMsg }}</div>
          <button class="btn btn-primary btn-sm" type="submit">Publicar reseña</button>
        </form>
      </div>
    </div>

    <!-- Modal Ver Informe — role="dialog" y aria-modal para lectores de pantalla -->
    <div v-if="informeModal" class="modal-overlay" @click.self="informeModal = null" role="presentation">
      <div class="modal-box card" role="dialog" aria-modal="true" aria-labelledby="informe-titulo">
        <div class="modal-header">
          <h2 id="informe-titulo">Informe médico</h2>
          <button class="btn btn-outline btn-sm" @click="informeModal = null" aria-label="Cerrar informe médico">✕</button>
        </div>
        <div class="informe-grid">
          <div>
            <div class="informe-label">Fecha</div>
            <div>{{ informeModal.fechaPreferida }} {{ informeModal.horaPreferida }}</div>
          </div>
          <div>
            <div class="informe-label">Servicio</div>
            <div>{{ informeModal.tipo }}</div>
          </div>
        </div>
        <div v-if="informeModal.diagnostico" class="informe-section">
          <div class="informe-label">Diagnóstico</div>
          <div class="informe-text">{{ informeModal.diagnostico }}</div>
        </div>
        <div v-if="informeModal.tratamiento" class="informe-section">
          <div class="informe-label">Tratamiento / Receta</div>
          <div class="informe-text">{{ informeModal.tratamiento }}</div>
        </div>
        <div v-if="!informeModal.diagnostico && !informeModal.tratamiento" class="muted-text informe-section">
          El veterinario aún no ha completado el informe.
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getMiCuenta, actualizarPerfil, actualizarPreferencias } from '../api/usuario'
import { crearMascota, eliminarMascota as apiEliminarMascota } from '../api/mascotas'
import { crearResena } from '../api/resenas'

const data    = ref({})
const loading = ref(true)
const informeModal = ref(null)

const perfil   = ref({ nombre: '', email: '' })
const perfilMsg = ref(''); const perfilOk = ref(false)

const prefs    = ref({ theme: 'light', font_size: 'medium' })
const prefsMsg = ref(''); const prefsOk = ref(false)

const showMascotaForm = ref(false)
const nuevaMascota = ref({ nombre: '', tipo: '', raza: '', genero: '', edad: null, peso: null, notasMedicas: '' })
const mascotaError = ref('')

const resena    = ref({ calificacion: 5, comentario: '' })
const resenaMsg = ref(''); const resenaOk = ref(false)

function estadoBadge(estado) {
  const map = { PENDIENTE: 'badge-yellow', CONFIRMADA: 'badge-green', CANCELADA: 'badge-red', COMPLETADA: 'badge-blue' }
  return map[estado] || 'badge-gray'
}

function verInforme(cita) { informeModal.value = cita }

async function recargar() {
  const { data: d } = await getMiCuenta()
  data.value = d
}

onMounted(async () => {
  await recargar()
  perfil.value = { nombre: data.value.usuario.nombre, email: data.value.usuario.email }
  loading.value = false
})

async function guardarPerfil() {
  try {
    await actualizarPerfil(perfil.value.nombre, perfil.value.email)
    perfilMsg.value = 'Perfil actualizado'; perfilOk.value = true
  } catch (e) { perfilMsg.value = e.response?.data?.error || 'Error'; perfilOk.value = false }
}

async function guardarPrefs() {
  try {
    await actualizarPreferencias(prefs.value)
    prefsMsg.value = 'Preferencias guardadas'; prefsOk.value = true
  } catch { prefsMsg.value = 'Error'; prefsOk.value = false }
}

async function agregarMascota() {
  mascotaError.value = ''
  try {
    await crearMascota(nuevaMascota.value)
    await recargar()
    nuevaMascota.value = { nombre: '', tipo: '', raza: '', genero: '', edad: null, peso: null, notasMedicas: '' }
    showMascotaForm.value = false
  } catch (e) { mascotaError.value = e.response?.data?.error || 'Error al registrar la mascota' }
}

async function eliminarMascota(id) {
  if (!confirm('¿Eliminar mascota?')) return
  await apiEliminarMascota(id)
  await recargar()
}

async function publicarResena() {
  try {
    await crearResena(resena.value.calificacion, resena.value.comentario)
    resenaMsg.value = 'Reseña publicada'; resenaOk.value = true
    resena.value = { calificacion: 5, comentario: '' }
  } catch (e) { resenaMsg.value = e.response?.data?.error || 'Error'; resenaOk.value = false }
}
</script>

<style scoped>
/* Texto solo para lectores de pantalla */
.sr-only {
  position: absolute;
  width: 1px; height: 1px;
  padding: 0; margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border: 0;
}
.cuenta-container { max-width: 900px; padding-top: 2rem; }
.card-mt { margin-top: 1.25rem; }
.btn-mt { margin-top: .75rem; }
.muted-mb { margin-bottom: .75rem; }

.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
@media (max-width: 700px) { .grid-2 { grid-template-columns: 1fr; } }

.section-head { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); }
.muted-text   { font-size: .85rem; color: var(--muted); }

.mascotas-grid { display: flex; flex-direction: column; gap: .6rem; margin-bottom: .5rem; }
.mascota-card  { display: flex; align-items: center; gap: .75rem; padding: .6rem .75rem; background: #f9fafb; border-radius: 10px; }
.mascota-icon  { font-size: 1.4rem; }
.mascota-info  { flex: 1; }
.mascota-nombre { font-weight: 600; font-size: .95rem; }

.mascota-form { display: flex; flex-direction: column; gap: .5rem; border-top: 1px solid var(--border); padding-top: .75rem; margin-top: .5rem; }
.form-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }

/* Modal */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.45);
  display: flex; align-items: center; justify-content: center;
  z-index: 1000; padding: 1rem;
}
.modal-box { width: 100%; max-width: 520px; }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
.modal-header h2 { font-size: 1.1rem; font-weight: 800; }
.informe-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
.informe-label { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--muted); margin-bottom: .2rem; }
.informe-text { background: #f9fafb; border-radius: 8px; padding: .75rem; font-size: .9rem; line-height: 1.6; white-space: pre-wrap; }
.informe-section { margin-top: 1rem; }
</style>
