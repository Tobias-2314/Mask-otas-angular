<template>
  <div class="container" style="max-width:900px">
    <div class="page-header" style="text-align:center">
      <h1>Contáctanos</h1>
      <p style="color:var(--muted)">Estamos aquí para resolver tus dudas. Visítanos o envíanos un mensaje.</p>
    </div>

    <div class="contact-layout">
      <!-- Info -->
      <div class="contact-info">
        <h2>Información de contacto</h2>
        <div class="info-item" v-for="item in info" :key="item.label">
          <span class="info-icon">{{ item.icon }}</span>
          <div>
            <div class="info-label">{{ item.label }}</div>
            <div class="info-value">{{ item.value }}</div>
          </div>
        </div>
        <div class="horario card" style="margin-top:1.5rem">
          <h3>Horario</h3>
          <table class="horario-table">
            <tr v-for="h in horario" :key="h.dia"><td>{{ h.dia }}</td><td>{{ h.hora }}</td></tr>
          </table>
        </div>
      </div>

      <!-- Form -->
      <div class="contact-form card">
        <h2>Envíanos un mensaje</h2>
        <div v-if="enviado" class="alert alert-success">¡Mensaje enviado! Te responderemos pronto.</div>
        <form v-else @submit.prevent="enviar">
          <div class="form-group">
            <label>Nombre</label>
            <input v-model="form.nombre" required placeholder="Tu nombre" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" v-model="form.email" required placeholder="tu@email.com" />
          </div>
          <div class="form-group">
            <label>Asunto</label>
            <input v-model="form.asunto" required placeholder="¿En qué podemos ayudarte?" />
          </div>
          <div class="form-group">
            <label>Mensaje</label>
            <textarea v-model="form.mensaje" rows="4" required placeholder="Escribe tu mensaje aquí..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%">Enviar Mensaje</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const enviado = ref(false)
const form = reactive({ nombre: '', email: '', asunto: '', mensaje: '' })

const info = [
  { icon: '📍', label: 'Dirección', value: 'Calle Veterinaria 123, Madrid' },
  { icon: '📞', label: 'Teléfono', value: '+34 912 345 678' },
  { icon: '✉️', label: 'Email', value: 'info@maskotas.com' },
]

const horario = [
  { dia: 'Lun – Vie', hora: '9:00 – 20:00' },
  { dia: 'Sábado',   hora: '10:00 – 14:00' },
  { dia: 'Domingo',  hora: 'Cerrado' },
]

function enviar() {
  // Formulario de contacto estático (sin backend)
  enviado.value = true
}
</script>

<style scoped>
.contact-layout { display: grid; grid-template-columns: 1fr 1.4fr; gap: 2rem; align-items: start; }
@media (max-width: 680px) { .contact-layout { grid-template-columns: 1fr; } }

.contact-info h2, .contact-form h2 { font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; }
.info-item { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1.25rem; }
.info-icon { font-size: 1.4rem; }
.info-label { font-size: .75rem; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }
.info-value { font-weight: 600; }

.horario h3 { font-size: .9rem; font-weight: 700; margin-bottom: .75rem; color: var(--primary); }
.horario-table { width: 100%; border-collapse: collapse; font-size: .9rem; }
.horario-table td { padding: .3rem 0; }
.horario-table td:last-child { text-align: right; color: var(--muted); }
</style>
