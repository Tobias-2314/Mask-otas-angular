<template>
  <div class="container legal-page">
    <div class="page-header" style="text-align:center">
      <h1>Política de Privacidad</h1>
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
    titulo: '1. Responsable del Tratamiento',
    parrafos: [
      'En cumplimiento del Reglamento (UE) 2016/679 (RGPD) y la Ley Orgánica 3/2018 (LOPDGDD), el responsable del tratamiento es MASK!OTAS – Servicios Veterinarios S.L., con domicilio en Calle Veterinaria 123, Madrid.',
      'Contacto: info@maskotas.com | +34 912 345 678'
    ]
  },
  {
    titulo: '2. Datos que Recogemos',
    parrafos: [
      'Recogemos los datos que usted nos proporciona al registrarse: nombre, correo electrónico y contraseña cifrada.',
      'Al agendar citas, recogemos información sobre usted y su mascota necesaria para la prestación del servicio.',
      'Al realizar compras, procesamos los datos necesarios para gestionar el pedido.'
    ]
  },
  {
    titulo: '3. Finalidad del Tratamiento',
    parrafos: [
      'Gestión de la cuenta de usuario y acceso a los servicios de la plataforma.',
      'Prestación de servicios veterinarios y gestión de citas.',
      'Procesamiento de pedidos en la tienda online.',
      'Comunicaciones relacionadas con sus servicios contratados.'
    ]
  },
  {
    titulo: '4. Conservación de Datos',
    parrafos: [
      'Sus datos se conservarán mientras mantenga su cuenta activa. Una vez solicitada la baja, los datos se eliminarán en un plazo máximo de 30 días, salvo obligación legal de conservación.'
    ]
  },
  {
    titulo: '5. Sus Derechos',
    parrafos: [
      'Puede ejercer sus derechos de acceso, rectificación, supresión, oposición, limitación del tratamiento y portabilidad contactando a info@maskotas.com.',
      'También tiene derecho a presentar una reclamación ante la Agencia Española de Protección de Datos (www.aepd.es).'
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
