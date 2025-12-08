# 🐾 MASK!OTAS - Proyecto Angular

Versión Angular de la clínica veterinaria MASK!OTAS. Este proyecto es una recreación completa del sitio web original desarrollado en HTML/CSS/JS vanilla, ahora usando Angular 18.

## 📋 Características

✅ **Arquitectura Angular Moderna**
- Componentes standalone (sin NgModules)
- Lazy loading de rutas
- Formularios reactivos
- HttpClient para APIs
- TypeScript strict mode

✅ **Funcionalidades Implementadas**
- 🏠 Página de inicio con hero section, servicios, blog y testimonios
- 🏥 Página de servicios detallados
- 📅 Sistema de reserva de citas
- 📧 Formulario de contacto
- 📝 Blog (cuidados, nutrición, ejercicios)
- 🔐 Sistema de autenticación (login/registro)
- 🍪 Popup de cookies conforme RGPD
- 📱 Diseño 100% responsive
- 🌐 Integración con Google Translate
- 📊 Dashboard administrativo (básico)

## 🚀 Instalación y Uso

### Prerrequisitos

- Node.js 18+ instalado
- npm o yarn

### Pasos de Instalación

```bash
# 1. Navegar al directorio del proyecto
cd C:\Users\tobia\Documents\Proyecto-Mask!otas\proyecto-veterinaria-angular

# 2. Instalar dependencias
npm install

# 3. Iniciar servidor de desarrollo
npm start

# El proyecto estará disponible en http://localhost:4200
```

### Compilar para Producción

```bash
npm run build

# Los archivos compilados estarán en dist/proyecto-veterinaria-angular
```

## 📁 Estructura del Proyecto

```
src/
├── app/
│   ├── core/
│   │   └── services/         # Servicios globales (auth, location, notification)
│   ├── shared/
│   │   └── components/       # Componentes compartidos (navbar, footer, modals)
│   ├── features/             # Módulos de funcionalidades
│   │   ├── home/
│   │   ├── services/
│   │   ├── appointments/
│   │   ├── contact/
│   │   ├── blog/
│   │   ├── admin-dashboard/
│   │   ├── legal/
│   │   └── gracias/
│   ├── app.component.ts
│   ├── app.routes.ts         # Configuración de rutas
│   └── app.config.ts
├── environments/              # Configuraciones de entorno
├── assets/                    # Imágenes, videos, etc
└── styles.scss               # Estilos globales
```

## 🔗 Integración con Backend

El proyecto está configurado para conectarse con las APIs PHP existentes:

**Desarrollo**: `http://localhost:8000/api`  
**Producción**: `https://54.91.80.228/api`

### APIs Disponibles

- `POST /api/login-user.php` - Autenticación
- `POST /api/register-user.php` - Registro de usuarios
- `GET /api/get-countries.php` - Lista de países
- `GET /api/get-cities.php?country=XX` - Ciudades por país
- `GET /api/dashboard-data.php` - Datos del dashboard

## ⚙️ Configuración

### Cambiar URL de API

Edita los archivos en `src/environments/`:

```typescript
// environment.development.ts
export const environment = {
  production: false,
  apiUrl: 'TU_URL_AQUI/api'
};
```

## 🎨 Estilos y Diseño

El proyecto mantiene la identidad visual del original:

- **Color principal**: `#009688` (verde azulado)
- **Tipografía**: Arial, sans-serif
- **Diseño**: Mobile-first, responsive
- **Iconos**: Font Awesome 6.0

## 📝 Próximos Pasos y Mejoras

### Para Completar el Proyecto

1. **Copiar Assets** (IMPORTANTE)
   ```bash
   # Copiar imágenes
   cp -r ../proyecto-veterinaria-maskotas/imagenes ./public/imagenes
   
   # Copiar videos
   cp -r ../proyecto-veterinaria-maskotas/videos ./public/videos
   ```

2. **Implementar Dashboard Completo**
   - Conectar con API `dashboard-data.php`
   - Crear gráficos con Chart.js o similar
   - Añadir tablas interactivas

3. **Añadir Guards de Autenticación**
   - Crear `auth.guard.ts` para proteger rutas
   - Implementar AuthGuard en ruta del dashboard

4. **Mejoras de UI/UX**
   - Añadir loading spinners
   - Animaciones de transición entre páginas
   - Componente de notificaciones toast

5. **Tests**
   - Unit tests para servicios
   - Component tests
   - E2E tests con Cypress/Playwright

### Funcionalidades Adicionales Sugeridas

- [ ] PWA (Progressive Web App)
- [ ] Internacionalización avanzada (i18n)
- [ ] Sistema de citas con calendario interactivo
- [ ] Chat en vivo
- [ ] Historial de mascotas
- [ ] Sistema de pagos

## 🐛 Troubleshooting

### Error: Cannot find module '@angular/core'
```bash
npm install
```

### Error de CORS al conectar con API
Verifica que el backend tenga configurado CORS correctamente para permitir peticiones desde `http://localhost:4200`

### Imágenes no se muestran
Verifica que los assets estén en la carpeta `public/` y que las rutas en los componentes sean correctas.

## 📄 Licencia

Este proyecto es parte del trabajo académico del Grado en Desarrollo de Aplicaciones Web (DAW).

## 👥 Contacto

Para consultas sobre el proyecto:
- **Email**: info@MASK!OTAS.com
- **Ubicación**: C/ dels Sants Just i Pastor, 70, 46940 Manises, València

---

**MASK!OTAS** - _Porque son algo más que mascotas_ 🐾
