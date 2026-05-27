<template>
  <div class="container legal-page">
    <div class="page-header" style="text-align:center">
      <h1>Política de Cookies</h1>
      <p style="color:var(--muted)">Última actualización: 10 de febrero de 2026</p>
    </div>

    <div class="card legal-content">
      <section v-for="s in secciones" :key="s.titulo" class="legal-section">
        <h2>{{ s.titulo }}</h2>
        <p v-for="(p, i) in s.parrafos" :key="i">{{ p }}</p>
      </section>

      <section class="legal-section">
        <h2>3. Tipos de Cookies que Utilizamos</h2>
        <table class="cookies-table">
          <thead><tr><th>Nombre</th><th>Tipo</th><th>Duración</th><th>Finalidad</th></tr></thead>
          <tbody>
            <tr v-for="c in cookies" :key="c.nombre">
              <td><code>{{ c.nombre }}</code></td>
              <td>{{ c.tipo }}</td>
              <td>{{ c.duracion }}</td>
              <td>{{ c.finalidad }}</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section class="legal-section">
        <h2>4. Gestión de Cookies</h2>
        <p>Puede configurar su navegador para rechazar o eliminar cookies. Tenga en cuenta que algunas funcionalidades del sitio pueden verse afectadas si deshabilita las cookies técnicas.</p>
      </section>
    </div>
  </div>
</template>

<script setup>
const secciones = [
  {
    titulo: '1. ¿Qué son las Cookies?',
    parrafos: [
      'Las cookies son pequeños archivos de texto que los sitios web almacenan en su dispositivo para recordar información sobre su visita y mejorar la experiencia de navegación.'
    ]
  },
  {
    titulo: '2. Base Legal',
    parrafos: [
      'El uso de cookies técnicas está basado en el interés legítimo para el funcionamiento del sitio. Las cookies analíticas y de preferencias requieren su consentimiento.'
    ]
  }
]

const cookies = [
  { nombre: 'JSESSIONID', tipo: 'Técnica', duracion: 'Sesión', finalidad: 'Mantiene la sesión del usuario autenticado' },
  { nombre: 'darkMode', tipo: 'Preferencia', duracion: '1 año', finalidad: 'Recuerda el modo oscuro seleccionado' },
  { nombre: 'fontSize', tipo: 'Preferencia', duracion: '1 año', finalidad: 'Recuerda el tamaño de fuente seleccionado' },
]
</script>

<style scoped>
.legal-page { max-width: 780px; }
.legal-content { padding: 2rem 2.5rem; }
.legal-section { margin-bottom: 2rem; }
.legal-section h2 { font-size: 1.05rem; font-weight: 700; color: var(--primary); margin-bottom: .75rem; }
.legal-section p { color: var(--muted); font-size: .93rem; line-height: 1.7; margin-bottom: .5rem; }

.cookies-table { width: 100%; border-collapse: collapse; font-size: .85rem; }
.cookies-table th { background: #f3f4f6; text-align: left; padding: .6rem .75rem; font-weight: 600; }
.cookies-table td { padding: .6rem .75rem; border-top: 1px solid var(--border); color: var(--muted); }
code { background: #f3f4f6; padding: .1rem .4rem; border-radius: 4px; font-size: .8rem; }
</style>
