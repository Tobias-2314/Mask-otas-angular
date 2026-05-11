<template>
  <div class="container" style="max-width:900px;padding-top:2rem">
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
            <div class="form-group"><label>Nombre</label><input v-model="perfil.nombre" required /></div>
            <div class="form-group"><label>Email</label><input type="email" v-model="perfil.email" required /></div>
            <div v-if="perfilMsg" :class="['alert', perfilOk ? 'alert-success' : 'alert-error']">{{ perfilMsg }}</div>
            <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
          </form>
        </div>

        <!-- Mascotas -->
        <div class="card">
          <h2 class="section-head">Mis mascotas</h2>
          <div v-if="data.mascotas?.length === 0" class="muted-text">Sin mascotas registradas.</div>
          <ul class="simple-list">
            <li v-for="m in data.mascotas" :key="m.id">
              🐾 {{ m.nombre }} <span class="muted-text">({{ m.tipo }})</span>
              <button class="btn btn-danger btn-sm" style="float:right" @click="eliminarMascota(m.id)">✕</button>
            </li>
          </ul>
          <form @submit.prevent="agregarMascota" class="mini-form">
            <input v-model="nuevaMascota.nombre" placeholder="Nombre" required />
            <input v-model="nuevaMascota.tipo" placeholder="Tipo (perro, gato…)" required />
            <button class="btn btn-primary btn-sm" type="submit">Agregar</button>
          </form>
        </div>

        <!-- Pedidos -->
        <div class="card">
          <h2 class="section-head">Mis pedidos</h2>
          <div v-if="data.orders?.length === 0" class="muted-text">Sin pedidos.</div>
          <table v-else class="table">
            <thead><tr><th>#</th><th>Fecha</th><th>Total</th></tr></thead>
            <tbody>
              <tr v-for="o in data.orders" :key="o.id">
                <td>#{{ o.id }}</td>
                <td>{{ o.fecha?.split('T')[0] }}</td>
                <td>${{ o.total?.toFixed(2) }}</td>
              </tr>
            </tbody>
          </table>
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
            <div v-if="prefsMsg" :class="['alert', prefsOk ? 'alert-success' : 'alert-error']">{{ prefsMsg }}</div>
            <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
          </form>
        </div>
      </div>

      <!-- Reseñas -->
      <div class="card" style="margin-top:1.5rem">
        <h2 class="section-head">Dejar una reseña</h2>
        <form @submit.prevent="publicarResena">
          <div class="form-row">
            <div class="form-group">
              <label>Calificación</label>
              <select v-model="resena.calificacion">
                <option v-for="n in 5" :key="n" :value="n">{{ '★'.repeat(n) }}</option>
              </select>
            </div>
          </div>
          <div class="form-group"><label>Comentario</label><textarea v-model="resena.comentario" rows="3" required></textarea></div>
          <div v-if="resenaMsg" :class="['alert', resenaOk ? 'alert-success' : 'alert-error']">{{ resenaMsg }}</div>
          <button class="btn btn-primary btn-sm" type="submit">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getMiCuenta, actualizarPerfil, actualizarPreferencias } from '../api/usuario'
import { getMascotas, crearMascota, eliminarMascota as apiEliminarMascota } from '../api/mascotas'
import { crearResena } from '../api/resenas'

const data = ref({})
const loading = ref(true)

const perfil = ref({ nombre: '', email: '' })
const perfilMsg = ref(''); const perfilOk = ref(false)

const prefs = ref({ theme: 'light', font_size: 'medium' })
const prefsMsg = ref(''); const prefsOk = ref(false)

const nuevaMascota = ref({ nombre: '', tipo: '' })
const resena = ref({ calificacion: 5, comentario: '' })
const resenaMsg = ref(''); const resenaOk = ref(false)

onMounted(async () => {
  const { data: d } = await getMiCuenta()
  data.value = d
  perfil.value = { nombre: d.usuario.nombre, email: d.usuario.email }
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
  try {
    await crearMascota(nuevaMascota.value)
    const { data: d } = await getMiCuenta()
    data.value = d
    nuevaMascota.value = { nombre: '', tipo: '' }
  } catch (e) { alert(e.response?.data?.error || 'Error') }
}

async function eliminarMascota(id) {
  if (!confirm('¿Eliminar mascota?')) return
  await apiEliminarMascota(id)
  const { data: d } = await getMiCuenta()
  data.value = d
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
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
@media (max-width: 700px) { .grid-2 { grid-template-columns: 1fr; } }
.section-head { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); }
.muted-text { font-size: .85rem; color: var(--muted); }
.simple-list { list-style: none; display: flex; flex-direction: column; gap: .5rem; margin-bottom: .75rem; }
.simple-list li { font-size: .9rem; }
.mini-form { display: flex; gap: .5rem; margin-top: .75rem; flex-wrap: wrap; }
.mini-form input { flex: 1; padding: .45rem .75rem; border: 1.5px solid var(--border); border-radius: 8px; font-size: .85rem; min-width: 100px; }
.mini-form input:focus { outline: none; border-color: var(--primary); }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
</style>
