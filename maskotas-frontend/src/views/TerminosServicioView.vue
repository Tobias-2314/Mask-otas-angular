<template>
  <div class="container legal-page">
    <div class="page-header" style="text-align:center">
      <h1>Términos de Servicio</h1>
      <p style="color:var(--muted)">Última actualización: 10 de febrero de 2026</p>
    </div>

    <div class="card legal-content">
      <section v-for="s in secciones" :key="s.titulo" class="legal-section">
        <h2>{{ s.titulo }}</h2>
        <p v-for="(p, i) in s.parrafos" :key="i">{{ p }}</p>
      </section>
    </div>
  </div>
</template>

<script setup>
const secciones = [
  {
    titulo: '1. Aceptación de los Términos',
    parrafos: [
      'Al acceder y utilizar los servicios de MASK!OTAS, usted acepta quedar vinculado por los presentes Términos de Servicio. Si no está de acuerdo con alguno de estos términos, no utilice nuestros servicios.'
    ]
  },
  {
    titulo: '2. Descripción del Servicio',
    parrafos: [
      'MASK!OTAS ofrece una plataforma de gestión de citas veterinarias, tienda de productos para mascotas y gestión del historial médico de sus animales.',
      'Los servicios veterinarios presenciales son prestados por profesionales colegiados y regulados por la normativa vigente.'
    ]
  },
  {
    titulo: '3. Cuenta de Usuario',
    parrafos: [
      'Para acceder a determinados servicios es necesario crear una cuenta. Usted es responsable de mantener la confidencialidad de sus credenciales.',
      'Debe notificarnos inmediatamente si detecta un uso no autorizado de su cuenta.'
    ]
  },
  {
    titulo: '4. Citas y Cancelaciones',
    parrafos: [
      'Las citas pueden cancelarse con al menos 24 horas de antelación sin coste. Las cancelaciones con menos de 24 horas de antelación pueden estar sujetas a una tarifa de gestión.',
      'MASK!OTAS se reserva el derecho a cancelar citas en circunstancias excepcionales, notificándolo al usuario con la mayor antelación posible.'
    ]
  },
  {
    titulo: '5. Tienda Online',
    parrafos: [
      'Los precios de los productos incluyen el IVA aplicable. El pago es simulado con fines demostrativos y no se realizará ningún cargo real.',
      'Los pedidos se procesarán en el orden en que sean recibidos, sujeto a disponibilidad de stock.'
    ]
  },
  {
    titulo: '6. Limitación de Responsabilidad',
    parrafos: [
      'MASK!OTAS no será responsable de daños indirectos o consecuentes derivados del uso o imposibilidad de uso de los servicios.',
      'La información médica proporcionada en la plataforma tiene carácter orientativo y no sustituye a la consulta veterinaria presencial.'
    ]
  },
  {
    titulo: '7. Modificaciones',
    parrafos: [
      'MASK!OTAS se reserva el derecho a modificar estos Términos en cualquier momento. Los cambios serán notificados a los usuarios registrados y publicados en esta página.'
    ]
  }
]
</script>

<style scoped>
.legal-page { max-width: 780px; }
.legal-content { padding: 2rem 2.5rem; }
.legal-section { margin-bottom: 2rem; }
.legal-section h2 { font-size: 1.05rem; font-weight: 700; color: var(--primary); margin-bottom: .75rem; }
.legal-section p { color: var(--muted); font-size: .93rem; line-height: 1.7; margin-bottom: .5rem; }
</style>
