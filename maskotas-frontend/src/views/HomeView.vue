<template>
  <div>
    <!-- ── Hero ──────────────────────────────────────────────── -->
    <section class="hero">
      <div class="hero-bg">
        <div class="hero-orb orb-1"></div>
        <div class="hero-orb orb-2"></div>
        <div class="hero-orb orb-3"></div>
        <div class="hero-grid-lines"></div>
      </div>

      <div class="container hero-inner">
        <div class="hero-content fade-up">
          <div class="hero-pill">
            <span class="hero-pill-dot"></span>
            Clínica Veterinaria de Confianza
          </div>
          <h1 class="hero-title">
            Tu mascota,<br>
            <em>nuestra prioridad.</em>
          </h1>
          <p class="hero-desc">
            Servicios veterinarios de primera clase con un equipo apasionado por el bienestar animal. En Maskotas, el cuidado es nuestra vocación.
          </p>
          <div class="hero-btns">
            <RouterLink to="/citas" class="btn btn-accent btn-lg">Agendar Cita</RouterLink>
            <RouterLink to="/servicios" class="btn btn-outline-dark btn-lg">Ver Servicios</RouterLink>
          </div>
        </div>

        <!-- Decorative visual -->
        <div class="hero-visual fade-up-3" aria-hidden="true">
          <div class="vis-ring vis-ring-outer"></div>
          <div class="vis-ring vis-ring-inner"></div>
          <div class="vis-circle">
            <svg class="vis-paw" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <ellipse cx="30" cy="36" rx="11" ry="13.5" transform="rotate(-12 30 36)"/>
              <ellipse cx="50" cy="28" rx="11" ry="13.5"/>
              <ellipse cx="70" cy="36" rx="11" ry="13.5" transform="rotate(12 70 36)"/>
              <ellipse cx="17" cy="53" rx="8" ry="10" transform="rotate(-20 17 53)"/>
              <ellipse cx="50" cy="67" rx="22" ry="17"/>
            </svg>
          </div>
          <div class="vis-badge vis-badge-top">
            <div class="vbadge-icon">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            </div>
            <div>
              <strong>Certificados</strong>
              <span>Vets profesionales</span>
            </div>
          </div>
          <div class="vis-badge vis-badge-bottom">
            <div class="vbadge-icon urgent">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </div>
            <div>
              <strong>24 horas</strong>
              <span>Emergencias</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Stats bar -->
      <div class="hero-stats-bar fade-up-2">
        <div class="container">
          <div class="hero-stats">
            <div class="stat" v-for="s in stats" :key="s.label">
              <div class="stat-num">{{ s.num }}</div>
              <div class="stat-label">{{ s.label }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="var(--cream)"/>
        </svg>
      </div>
    </section>

    <!-- ── Por qué elegirnos ─────────────────────────────────── -->
    <section class="features-section">
      <div class="container">
        <div class="section-intro fade-up">
          <span class="eyebrow">Por qué elegirnos</span>
          <h2>Medicina veterinaria<br><em>con corazón</em></h2>
          <p>Combinamos experiencia médica con trato humano y cercano para que tú y tu mascota se sientan en casa.</p>
        </div>
        <div class="features-grid">
          <div class="feature-card fade-up-1" v-for="(f, i) in features" :key="i" :style="{ '--accent-color': f.color }">
            <div class="feature-num">{{ String(i + 1).padStart(2, '0') }}</div>
            <div class="feature-icon-wrap">
              <div class="feature-icon" v-html="f.svg"></div>
            </div>
            <h3>{{ f.title }}</h3>
            <p>{{ f.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Servicios strip ───────────────────────────────────── -->
    <section class="services-strip">
      <div class="container">
        <div class="strip-header">
          <div>
            <span class="eyebrow light">Lo que ofrecemos</span>
            <h2>Cuidado integral<br><em>para cada paciente</em></h2>
          </div>
          <RouterLink to="/servicios" class="btn btn-outline-dark">Ver todos los servicios</RouterLink>
        </div>
        <div class="strip-grid">
          <div class="strip-item" v-for="s in services" :key="s.name">
            <div class="strip-icon" v-html="s.svg"></div>
            <span>{{ s.name }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Reseñas ───────────────────────────────────────────── -->
    <section class="reviews-section">
      <div class="container">
        <div class="section-intro fade-up">
          <span class="eyebrow">Testimonios</span>
          <h2>Clientes felices,<br><em>mascotas más felices</em></h2>
        </div>
        <div v-if="loading" class="loading" style="color:var(--text-muted)">Cargando reseñas…</div>
        <div v-else class="reviews-grid">
          <div v-for="(r, i) in resenas" :key="r.id" :class="['review-card', `fade-up-${(i % 4) + 1}`]">
            <div class="review-quote-bg">❝</div>
            <div class="review-stars">
              <span v-for="n in 5" :key="n" :class="['star', { filled: n <= r.calificacion }]">★</span>
            </div>
            <blockquote>"{{ r.comentario }}"</blockquote>
            <footer>
              <div class="review-avatar">{{ (r.usuario?.nombre || 'A').charAt(0).toUpperCase() }}</div>
              <span class="review-author">{{ r.usuario?.nombre || 'Anónimo' }}</span>
            </footer>
          </div>
        </div>
        <div class="reviews-cta">
          <RouterLink to="/resenas" class="btn btn-primary">Ver todas las reseñas</RouterLink>
        </div>
      </div>
    </section>

    <!-- ── CTA final ─────────────────────────────────────────── -->
    <section class="cta-section">
      <div class="cta-orb"></div>
      <div class="container cta-inner fade-up">
        <div class="cta-text">
          <span class="eyebrow light">Agenda ahora</span>
          <h2>¿Listo para darle<br><em>lo mejor a tu mascota?</em></h2>
          <p>Reserva una cita online en minutos. Horarios flexibles y atención personalizada.</p>
        </div>
        <div class="cta-actions">
          <RouterLink to="/citas" class="btn btn-accent btn-lg">Agendar Cita</RouterLink>
          <RouterLink to="/contacto" class="btn btn-outline-dark">Contáctanos</RouterLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getUltimas } from '../api/resenas'

const resenas = ref([])
const loading = ref(true)

const stats = [
  { num: '10+', label: 'Años de experiencia' },
  { num: '2.400+', label: 'Pacientes tratados' },
  { num: '98%', label: 'Clientes satisfechos' },
]

const features = [
  {
    color: 'var(--gold)',
    svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>`,
    title: 'Atención con Amor',
    desc: 'Tratamos a cada paciente como si fuera nuestra propia mascota, con paciencia y cariño genuino.',
  },
  {
    color: 'var(--sage)',
    svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`,
    title: 'Citas Flexibles',
    desc: 'Horarios extendidos y reservas online para adaptarnos a tu ritmo de vida.',
  },
  {
    color: 'var(--terracotta)',
    svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>`,
    title: 'Tecnología Avanzada',
    desc: 'Equipos de diagnóstico de última generación para resultados precisos y tratamientos efectivos.',
  },
]

const services = [
  { name: 'Consulta General', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>` },
  { name: 'Vacunación', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M3 3l6 6m0 0l1.5-1.5m-1.5 1.5L10.5 10M10.5 10L14 13.5M14 13.5l2-2m-2 2L21 21"/></svg>` },
  { name: 'Peluquería & Spa', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></svg>` },
  { name: 'Odontología', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2z"/><path d="M12 6v6l4 2"/></svg>` },
  { name: 'Laboratorio', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11l-5 5h16l-5-5V3"/></svg>` },
  { name: 'Cirugía', svg: `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 2v20M2 12h20"/></svg>` },
]

onMounted(async () => {
  try {
    const { data } = await getUltimas()
    resenas.value = data
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
/* ── Hero ───────────────────────────────────────────────────── */
.hero {
  position: relative;
  background: var(--deep);
  color: var(--cream);
  padding: 7rem 0 0;
  overflow: hidden;
}
.hero-bg { position: absolute; inset: 0; pointer-events: none; }
.hero-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(90px);
}
.orb-1 {
  width: 560px; height: 560px;
  background: var(--forest);
  top: -140px; right: -60px;
  opacity: 0.22;
}
.orb-2 {
  width: 320px; height: 320px;
  background: var(--gold);
  bottom: -80px; left: 5%;
  opacity: 0.08;
}
.orb-3 {
  width: 200px; height: 200px;
  background: var(--sage);
  top: 60%; left: 40%;
  opacity: 0.07;
}
.hero-grid-lines {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size: 60px 60px;
}

.hero-inner {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  gap: 3rem;
  padding-bottom: 5rem;
}

.hero-content { flex: 1; max-width: 580px; }

.hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.55rem;
  padding: 0.38rem 1rem;
  border: 1px solid rgba(192,138,58,.4);
  border-radius: 9999px;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 1.75rem;
}
.hero-pill-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--gold);
  animation: pulse-ring 2.5s ease infinite;
  flex-shrink: 0;
}

.hero-title {
  font-size: clamp(2.8rem, 5.5vw, 5rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 1.35rem;
  line-height: 1.08;
}
.hero-title em {
  font-style: italic;
  color: var(--gold-light);
}
.hero-desc {
  font-size: 1.05rem;
  color: rgba(253,249,243,.6);
  max-width: 500px;
  line-height: 1.8;
  margin-bottom: 2.5rem;
}
.hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }

/* ── Hero Visual ─────────────────────────────────────────────── */
.hero-visual {
  position: relative;
  width: 380px;
  height: 380px;
  flex-shrink: 0;
  margin-right: 60px;
}
.vis-ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid rgba(192,138,58,.2);
  pointer-events: none;
}
.vis-ring-outer {
  inset: -44px;
  animation: pulse-ring 3.8s ease infinite;
}
.vis-ring-inner {
  inset: -18px;
  border-color: rgba(192,138,58,.14);
  animation: pulse-ring 3.8s ease 1.3s infinite;
}
.vis-circle {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: linear-gradient(145deg, var(--forest) 0%, var(--deep) 75%);
  border: 1px solid rgba(192,138,58,.28);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  box-shadow: 0 32px 90px rgba(7,16,10,.65), inset 0 1px 0 rgba(255,255,255,.05);
}
.vis-circle::before {
  content: '';
  position: absolute;
  width: 65%;
  height: 65%;
  top: 8%;
  left: 12%;
  background: radial-gradient(ellipse, rgba(74,124,89,.22) 0%, transparent 70%);
}
.vis-paw {
  width: 46%;
  height: 46%;
  color: rgba(223,192,112,.7);
  position: relative;
  z-index: 1;
  animation: float 6.5s ease-in-out infinite;
}

.vis-badge {
  position: absolute;
  display: flex;
  align-items: center;
  gap: 0.65rem;
  background: rgba(253,249,243,.96);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid rgba(219,231,222,.85);
  border-radius: var(--radius-lg);
  padding: 0.7rem 1.1rem;
  box-shadow: 0 10px 36px rgba(7,16,10,.2);
  white-space: nowrap;
}
.vis-badge strong {
  display: block;
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--text);
  line-height: 1.25;
}
.vis-badge span {
  display: block;
  font-size: 0.67rem;
  color: var(--text-muted);
  line-height: 1.2;
}
.vis-badge-top {
  top: -28px;
  right: -58px;
  animation: float 7.5s ease-in-out 0.8s infinite;
}
.vis-badge-bottom {
  bottom: 22px;
  left: -60px;
  animation: float 5.8s ease-in-out 0.3s infinite;
}
.vbadge-icon {
  width: 32px; height: 32px;
  border-radius: 9px;
  background: var(--forest);
  color: var(--gold-light);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.vbadge-icon.urgent {
  background: var(--terracotta);
  color: #fff;
}

@media (max-width: 980px) {
  .hero-inner { flex-direction: column; align-items: flex-start; }
  .hero-visual { display: none; }
  .hero-content { max-width: 100%; }
}

/* ── Hero Stats Bar ──────────────────────────────────────────── */
.hero-stats-bar {
  position: relative;
  z-index: 1;
  border-top: 1px solid rgba(255,255,255,.07);
  background: rgba(22,54,32,.25);
}
.hero-stats {
  display: flex;
  justify-content: center;
}
.stat {
  flex: 1;
  max-width: 260px;
  text-align: center;
  padding: 1.85rem 1rem;
  border-right: 1px solid rgba(255,255,255,.06);
}
.stat:last-child { border-right: none; }
.stat-num {
  font-family: 'Fraunces', serif;
  font-size: 2.6rem;
  font-weight: 700;
  color: var(--gold-light);
  line-height: 1;
  margin-bottom: 0.25rem;
}
.stat-label {
  font-size: 0.75rem;
  color: rgba(253,249,243,.45);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-weight: 600;
}

.hero-wave {
  position: relative;
  z-index: 1;
  line-height: 0;
}
.hero-wave svg { width: 100%; height: 60px; }

/* ── Features ───────────────────────────────────────────────── */
.features-section { padding: 6.5rem 0 5.5rem; background: var(--cream); }
.section-intro {
  text-align: center;
  max-width: 560px;
  margin: 0 auto 4rem;
}
.eyebrow {
  display: inline-block;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--sage);
  margin-bottom: 0.75rem;
}
.eyebrow.light { color: var(--gold-light); }
.section-intro h2 {
  font-size: clamp(2rem, 4vw, 2.9rem);
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 0.9rem;
}
.section-intro h2 em { font-style: italic; color: var(--sage); }
.section-intro p { font-size: 0.97rem; color: var(--text-muted); line-height: 1.75; }

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
  gap: 1.5rem;
}
.feature-card {
  position: relative;
  background: #fff;
  border-radius: var(--radius-lg);
  padding: 2.25rem 2rem 2rem;
  border: 1px solid var(--border);
  border-top: 3px solid var(--accent-color, var(--border));
  overflow: hidden;
  transition: transform 0.3s var(--ease-out), box-shadow 0.3s var(--ease-out);
}
.feature-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow);
}
.feature-num {
  position: absolute;
  top: 1.25rem;
  right: 1.5rem;
  font-family: 'Fraunces', serif;
  font-size: 3.5rem;
  font-weight: 700;
  line-height: 1;
  color: rgba(23,28,20,.05);
  pointer-events: none;
  user-select: none;
}
.feature-icon-wrap {
  width: 50px; height: 50px;
  border-radius: 14px;
  background: var(--parchment);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 1.35rem;
  color: var(--accent-color, var(--sage));
  transition: background 0.25s;
}
.feature-card:hover .feature-icon-wrap {
  background: var(--sand);
}
.feature-card h3 {
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--deep);
  margin-bottom: 0.65rem;
}
.feature-card p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.75; }

/* ── Services strip ─────────────────────────────────────────── */
.services-strip {
  background: var(--forest);
  padding: 5.5rem 0;
  color: var(--cream);
}
.strip-header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 1.5rem;
  margin-bottom: 3rem;
  flex-wrap: wrap;
}
.strip-header h2 {
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 600;
  color: var(--cream);
}
.strip-header h2 em { font-style: italic; color: var(--gold-light); }

.strip-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
  gap: 1rem;
}
.strip-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  padding: 1.65rem 1rem;
  border-radius: var(--radius-lg);
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.09);
  transition: background 0.25s var(--ease-out), transform 0.25s var(--ease-out), border-color 0.25s;
  text-align: center;
  cursor: default;
}
.strip-item:hover {
  background: rgba(255,255,255,.12);
  border-color: rgba(192,138,58,.35);
  transform: translateY(-4px);
}
.strip-icon { color: var(--gold-light); }
.strip-item span {
  font-size: 0.8rem;
  font-weight: 600;
  letter-spacing: 0.02em;
  color: rgba(253,249,243,.75);
}

/* ── Reviews ────────────────────────────────────────────────── */
.reviews-section { padding: 6.5rem 0 5.5rem; background: var(--cream); }
.reviews-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2.75rem;
}
.review-card {
  position: relative;
  background: #fff;
  border-radius: var(--radius-lg);
  padding: 1.85rem;
  border: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  gap: 0.9rem;
  overflow: hidden;
  transition: transform 0.25s var(--ease-out), box-shadow 0.25s var(--ease-out);
}
.review-card:hover { transform: translateY(-5px); box-shadow: var(--shadow); }

.review-quote-bg {
  position: absolute;
  top: -0.25rem;
  left: 1rem;
  font-family: 'Fraunces', serif;
  font-size: 6rem;
  line-height: 1;
  color: rgba(74,124,89,.07);
  pointer-events: none;
  user-select: none;
}

.review-stars { display: flex; gap: 2px; position: relative; }
.star { font-size: 0.95rem; color: var(--border); }
.star.filled { color: var(--gold); }
blockquote {
  font-family: 'Fraunces', serif;
  font-size: 1.05rem;
  font-style: italic;
  color: var(--text);
  line-height: 1.7;
  flex: 1;
  position: relative;
}
.review-card footer { display: flex; align-items: center; gap: 0.7rem; }
.review-avatar {
  width: 34px; height: 34px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--forest), var(--sage));
  color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 0.8rem;
  flex-shrink: 0;
}
.review-author { font-size: 0.85rem; font-weight: 600; color: var(--text-muted); }
.reviews-cta { text-align: center; }

/* ── CTA final ──────────────────────────────────────────────── */
.cta-section {
  background: var(--deep);
  padding: 6.5rem 0;
  position: relative;
  overflow: hidden;
}
.cta-orb {
  position: absolute;
  width: 700px; height: 700px;
  border-radius: 50%;
  background: var(--forest);
  opacity: 0.22;
  filter: blur(110px);
  right: -150px; top: -250px;
  pointer-events: none;
}
.cta-inner {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 3rem;
  flex-wrap: wrap;
}
.cta-text .eyebrow { margin-bottom: 0.65rem; }
.cta-text h2 {
  font-size: clamp(2rem, 4vw, 3.1rem);
  font-weight: 600;
  color: var(--cream);
  margin-bottom: 0.9rem;
}
.cta-text h2 em { font-style: italic; color: var(--gold-light); }
.cta-text p { font-size: 0.97rem; color: rgba(253,249,243,.55); max-width: 420px; line-height: 1.75; }
.cta-actions { display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; }
</style>
