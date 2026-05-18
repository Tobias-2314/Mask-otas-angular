<template>
  <div>
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Estamos aquí</span>
        <h1>Contáctanos</h1>
        <p>Resolvemos tus dudas y estamos disponibles para cualquier consulta sobre el bienestar de tu mascota.</p>
      </div>
    </section>

    <section class="contacto-section">
      <div class="container contacto-layout">
        <!-- Info -->
        <div class="info-col">
          <h2>Información<br><em>de contacto</em></h2>

          <div class="info-items">
            <a href="#" class="info-item" v-for="item in info" :key="item.label">
              <div class="info-icon" v-html="item.svg"></div>
              <div>
                <div class="info-label">{{ item.label }}</div>
                <div class="info-value">{{ item.value }}</div>
              </div>
            </a>
          </div>

          <div class="horario-card">
            <h3>Horario de atención</h3>
            <div class="horario-rows">
              <div class="horario-row" v-for="h in horario" :key="h.dia" :class="{ closed: h.hora === 'Cerrado' }">
                <span class="h-dia">{{ h.dia }}</span>
                <span class="h-hora">{{ h.hora }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Formulario -->
        <div class="form-col card">
          <h2>Envíanos un<br><em>mensaje</em></h2>

          <div v-if="enviado" class="success-state">
            <div class="success-icon">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h3>¡Mensaje enviado!</h3>
            <p>Te responderemos lo antes posible.</p>
          </div>
          <form v-else @submit.prevent="enviar" class="contacto-form">
            <div class="form-row">
              <div class="form-group">
                <label>Nombre</label>
                <input v-model="form.nombre" required placeholder="Tu nombre" />
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" v-model="form.email" required placeholder="tu@email.com" />
              </div>
            </div>
            <div class="form-group">
              <label>Asunto</label>
              <input v-model="form.asunto" required placeholder="¿En qué podemos ayudarte?" />
            </div>
            <div class="form-group">
              <label>Mensaje</label>
              <textarea v-model="form.mensaje" rows="5" required placeholder="Escribe tu mensaje aquí…"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:.85rem">Enviar Mensaje</button>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const enviado = ref(false)
const form = reactive({ nombre: '', email: '', asunto: '', mensaje: '' })

const info = [
  {
    svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>`,
    label: 'Dirección',
    value: 'Calle Veterinaria 123, Madrid'
  },
  {
    svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16z"/></svg>`,
    label: 'Teléfono',
    value: '+34 912 345 678'
  },
  {
    svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>`,
    label: 'Email',
    value: 'info@maskotas.com'
  },
]

const horario = [
  { dia: 'Lunes – Viernes', hora: '9:00 – 20:00' },
  { dia: 'Sábado', hora: '10:00 – 14:00' },
  { dia: 'Domingo', hora: 'Cerrado' },
]

function enviar() { enviado.value = true }
</script>

<style scoped>
.page-hero {
  background: var(--deep);
  color: var(--cream);
  padding: 4.5rem 0 3.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 30%, rgba(26,61,31,.6) 0%, transparent 65%);
  pointer-events: none;
}
.page-hero .container { position: relative; z-index: 1; }
.eyebrow {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 0.65rem;
}
.page-hero h1 { font-size: clamp(2rem, 4.5vw, 3.5rem); font-weight: 600; color: var(--cream); margin-bottom: 1rem; }
.page-hero p { color: rgba(250,246,238,.65); max-width: 480px; margin: 0 auto; font-size: 0.97rem; line-height: 1.7; }

.contacto-section { padding: 5rem 0; background: var(--cream); }

.contacto-layout {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 4rem;
  align-items: start;
}
@media (max-width: 760px) {
  .contacto-layout { grid-template-columns: 1fr; gap: 2.5rem; }
}

.info-col h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 2rem;
}
.info-col h2 em { font-style: italic; color: var(--sage); }

.info-items { display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 2rem; }
.info-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1.1rem;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  background: #fff;
  transition: border-color 0.18s, box-shadow 0.18s;
  cursor: default;
}
.info-item:hover { border-color: var(--mint); box-shadow: var(--shadow-sm); }
.info-icon {
  width: 40px; height: 40px;
  border-radius: 10px;
  background: var(--parchment);
  display: flex; align-items: center; justify-content: center;
  color: var(--sage);
  flex-shrink: 0;
}
.info-label {
  font-size: 0.7rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-muted);
  margin-bottom: 0.2rem;
}
.info-value { font-size: 0.92rem; font-weight: 600; color: var(--text); }

.horario-card {
  background: var(--deep);
  border-radius: var(--radius-lg);
  padding: 1.5rem;
}
.horario-card h3 {
  font-size: 0.75rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--gold-light);
  margin-bottom: 1.1rem;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.horario-rows { display: flex; flex-direction: column; gap: 0.65rem; }
.horario-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 0.65rem;
  border-bottom: 1px solid rgba(255,255,255,.07);
}
.horario-row:last-child { border-bottom: none; padding-bottom: 0; }
.h-dia { font-size: 0.88rem; color: rgba(250,246,238,.8); font-weight: 500; }
.h-hora { font-size: 0.88rem; font-weight: 700; color: var(--cream); }
.horario-row.closed .h-hora { color: rgba(250,246,238,.4); }

.form-col h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 1.75rem;
}
.form-col h2 em { font-style: italic; color: var(--sage); }

.contacto-form { display: flex; flex-direction: column; }
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}
@media (max-width: 520px) { .form-row { grid-template-columns: 1fr; } }

.success-state {
  text-align: center;
  padding: 3rem 2rem;
}
.success-icon {
  width: 64px; height: 64px;
  border-radius: 50%;
  background: #f0fdf4;
  border: 2px solid #bbf7d0;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1.25rem;
  color: var(--success);
}
.success-state h3 { font-size: 1.5rem; font-weight: 600; color: var(--deep); margin-bottom: 0.4rem; }
.success-state p { font-size: 0.9rem; color: var(--text-muted); }
</style>
