# 🐾 MASK!OTAS Backend API

Backend NestJS para la clínica veterinaria MASK!OTAS. API REST completa con autenticación JWT, gestión de usuarios, citas, y más.

## 🚀 Características

- ✅ **Autenticación JWT** - Login y registro seguros
- ✅ **TypeORM** - ORM moderno para PostgreSQL
- ✅ **Validación** - class-validator en todos los endpoints
- ✅ **Módulos**:
  - Auth (registro, login, JWT)
  - Users (gestión de usuarios)
  - Appointments (citas veterinarias)
  - Location (países y ciudades)
  - Contact (formularios de contacto)
  - Newsletter (suscripciones)

## 📋 Requisitos

- Node.js 18+
- PostgreSQL 14+
- npm o yarn

## 🛠️ Instalación

```bash
# 1. Instalar dependencias
npm install

# 2. Configurar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales de base de datos

# 3.Crear base de datos PostgreSQL
createdb maskotas_db

# 4. Iniciar en desarrollo
npm run start:dev
```

## ⚙️ Configuración

### Variables de Entorno (.env)

```env
DATABASE_HOST=localhost
DATABASE_PORT=5432
DATABASE_USER=postgres
DATABASE_PASSWORD=tu-password
DATABASE_NAME=maskotas_db

JWT_SECRET=tu-secret-key-super-seguro
JWT_EXPIRATION=24h

PORT=3000
NODE_ENV=development
CORS_ORIGIN=http://localhost:4200
```

## 📡 API Endpoints

### Authentication

```
POST /api/auth/register - Registrar usuario
POST /api/auth/login - Iniciar sesión
GET /api/auth/profile - Obtener perfil (requiere token)
```

### Appointments

```
POST /api/appointments - Crear cita
GET /api/appointments - Listar citas (admin)
GET /api/appointments/:id - Ver cita
```

### Location

```
GET /api/location/countries - Lista de países
GET /api/location/cities/:countryCode - Ciudades por país
```

### Contact

```
POST /api/contact - Enviar mensaje de contacto
```

### Newsletter

```
POST /api/newsletter/subscribe - Suscribirse
```

## 🗃️ Base de Datos

### Tablas creadas automáticamente:

- `users` - Usuarios registrados
- `appointments` - Citas veterinarias
- `countries` - Países
- `cities` - Ciudades
- `contacts` - Mensajes de contacto
- `newsletter_subscriptions` - Suscripciones

### Seeders (Datos iniciales)

Los países y ciudades se pueden poblar con datos iniciales (pendiente de implementar).

## 🔒 Autenticación

El sistema usa JWT (JSON Web Tokens). Al hacer login, recibes un token que debes incluir en las peticiones protegidas:

```javascript
headers: {
  'Authorization': 'Bearer TU_TOKEN_AQUI'
}
```

## 🚀 Deploy

### Opción 1: Railway

```bash
# Conectar con GitHub y Railway auto-detectará NestJS
```

### Opción 2: Render

```bash
# Build Command: npm install && npm run build
# Start Command: npm run start:prod
```

### Opción 3: Docker

```bash
docker build -t maskotas-backend .
docker run -p 3000:3000 maskotas-backend
```

## 📝 Desarrollo

```bash
# Desarrollo con hot-reload
npm run start:dev

# Build para producción
npm run build

# Ejecutar producción
npm run start:prod

# Tests
npm run test

# Linting
npm run lint
```

## 🔧 Scripts disponibles

- `npm run start` - Iniciar aplicación
- `npm run start:dev` - Desarrollo con hot-reload
- `npm run start:prod` - Producción
- `npm run build` - Compilar TypeScript
- `npm run lint` - Lint código
- `npm run test` - Ejecutar tests

## 📂 Estructura del Proyecto

```
src/
├── auth/              # Autenticación JWT
├── users/             # Gestión de usuarios
├── appointments/      # Citas veterinarias
├── location/          # Países y ciudades
├── contact/           # Formularios de contacto
├── newsletter/        # Newsletter
├── main.ts            # Bootstrap
└── app.module.ts      # Módulo principal
```

## 🤝 Integración con Frontend

Este backend está diseñado para trabajar con el frontend Angular de MASK!OTAS. Asegúrate de:

1. Configurar CORS_ORIGIN con la URL de tu frontend
2. Actualizar la URL de API en el frontend (`environment.ts`)
3. Los endpoints coinciden con lo esperado por los servicios Angular

## 📄 Licencia

MIT - MASK!OTAS Team 2024

---

**MASK!OTAS** - _Porque son algo más que mascotas_ 🐾
