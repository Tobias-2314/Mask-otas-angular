# Documentación del Sistema de Reseñas en Tiempo Real

Este documento detalla la implementación del sistema de visualización de reseñas en la página principal, el cual se actualiza automáticamente sin necesidad de recargar la página.

## 1. Funcionamiento General

El sistema utiliza una arquitectura **Polling** (muestreo periódico) mediante **AJAX** (Fetch API).
1.  El navegador (cliente) solicita periódicamente al servidor las últimas reseñas.
2.  El servidor responde con un JSON que contiene las 3 reseñas más recientes.
3.  El navegador recibe los datos y actualiza el DOM (HTML) de la sección "Clientes Felices".

## 2. Componentes Implementados

### A. Backend (Laravel)

**1. Ruta API (`routes/web.php`)**
Se añadió una ruta específica para devolver datos JSON:
```php
Route::get('/api/ultimas-resenas', [AppControlador::class, 'ultimasResenas'])->name('api.resenas.latest');
```

**2. Controlador (`App/Http/Controllers/AppControlador.php`)**
Se creó el método `ultimasResenas()` que devuelve una respuesta JSON en lugar de una vista:
```php
public function ultimasResenas()
{
    // Obtiene las 3 últimas reseñas aprobadas junto con la información del usuario
    $resenas = Resena::where('aprobado', true)->latest()->take(3)->with('usuario')->get();
    return response()->json($resenas);
}
```

### B. Frontend (Blade + JavaScript)

**1. Vista (`resources/views/inicio.blade.php`)**
Se eliminó el formulario de creación de reseñas de la página principal (index) para mantenerla limpia, dejando solo la visualización.

**2. Script de Actualización Automática**
Se implementó un script que utiliza `setInterval` y `fetch`:

```javascript
setInterval(() => {
    fetch('/api/ultimas-resenas')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('resenas-container');
            container.innerHTML = ''; // Limpia el contenedor

            data.forEach(resena => {
                // ... Lógica para generar el HTML de cada tarjeta de reseña ...
                // Reconstruye las estrellas y la información del usuario
                // Inserta la tarjeta en el contenedor
            });
        })
        .catch(error => console.error('Error fetching reviews:', error));
}, 3000); // Se ejecuta cada 3 segundos
```

## 3. Base de Datos (MySQL)

Se migró exitosamente la configuración de la base de datos de SQLite a MySQL en el archivo `.env`:

*   **BD**: `maskotas_db`
*   **Conexión**: `mysql`
*   **Host**: `127.0.0.1`

Esto permite una mayor concurrencia y persistencia de datos adecuada para un entorno de producción o desarrollo avanzado.
