<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionControlador;
use App\Http\Controllers\AppControlador;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ChatbotControlador;

// Páginas Estáticas (Directas a Vista)
Route::view('/', 'inicio')->name('inicio');
Route::get('/', [AppControlador::class, 'inicio'])->name('inicio');
Route::get('/api/ultimas-resenas', [AppControlador::class, 'ultimasResenas'])->name('api.resenas.latest');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/politica-privacidad', 'politica-privacidad')->name('politica-privacidad');
Route::view('/politica-cookies', 'politica-cookies')->name('politica-cookies');
Route::view('/terminos-servicio', 'terminos-servicio')->name('terminos-servicio');

// Tienda
Route::get('/tienda', [ShopController::class, 'index'])->name('tienda');

// Carrito
Route::get('/carrito', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/carrito/agregar/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/carrito/eliminar/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
Route::patch('/carrito/incrementar/{id}', [App\Http\Controllers\CartController::class, 'increment'])->name('cart.increment');
Route::patch('/carrito/decrementar/{id}', [App\Http\Controllers\CartController::class, 'decrement'])->name('cart.decrement');

// Autenticación - Rutas separadas para GET y POST
Route::get('/login', [AutenticacionControlador::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AutenticacionControlador::class, 'login'])->name('login.post');
Route::get('/registro', [AutenticacionControlador::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [AutenticacionControlador::class, 'registro'])->name('registro.post');
Route::post('/logout', [AutenticacionControlador::class, 'logout'])->name('logout');

// Citas
Route::get('/citas/crear', [AppControlador::class, 'crearCita'])->name('citas.crear')->middleware('auth');
Route::post('/citas', [AppControlador::class, 'guardarCita'])->name('citas.guardar')->middleware('auth');
Route::get('/api/citas/ocupadas', [AppControlador::class, 'obtenerCitasOcupadas'])->name('citas.ocupadas');

// Reseñas
Route::get('/resenas', [AppControlador::class, 'verResenas'])->name('resenas.index');
Route::post('/resenas', [AppControlador::class, 'guardarResena'])->name('resenas.guardar')->middleware('auth');

// Mi Cuenta
Route::get('/mi-cuenta', [AppControlador::class, 'miCuenta'])->name('mi-cuenta')->middleware('auth');
Route::put('/mi-cuenta', [AppControlador::class, 'actualizarPerfil'])->name('mi-cuenta.actualizar')->middleware('auth');
Route::put('/mi-cuenta/preferencias', [AppControlador::class, 'actualizarPreferencias'])->name('mi-cuenta.preferencias')->middleware('auth');

// ========== PANEL DE ADMINISTRACIÓN ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [AdminControlador::class, 'dashboard'])->name('dashboard');

    // Gestión de Usuarios
    Route::get('/usuarios', [AdminControlador::class, 'usuarios'])->name('usuarios');
    Route::get('/usuarios/crear', [AdminControlador::class, 'crearUsuario'])->name('usuarios.crear');
    Route::post('/usuarios', [AdminControlador::class, 'guardarUsuario'])->name('usuarios.guardar');
    Route::delete('/usuarios/{id}', [AdminControlador::class, 'eliminarUsuario'])->name('usuarios.eliminar');

    // Gestión de Citas
    Route::get('/citas', [AdminControlador::class, 'citas'])->name('citas');
    Route::patch('/citas/{id}/estado', [AdminControlador::class, 'actualizarEstadoCita'])->name('citas.estado');
    Route::delete('/citas/{id}', [AdminControlador::class, 'eliminarCita'])->name('citas.eliminar');
    Route::get('/citas/{id}/editar', [AdminControlador::class, 'editarCita'])->name('citas.editar');
    Route::put('/citas/{id}', [AdminControlador::class, 'actualizarCita'])->name('citas.actualizar');

    // Gestión de Reseñas
    Route::get('/resenas', [AdminControlador::class, 'resenas'])->name('resenas');
    Route::delete('/resenas/{id}', [AdminControlador::class, 'eliminarResena'])->name('resenas.eliminar');

    // Gestión de Productos
    Route::get('/productos', [AdminControlador::class, 'productos'])->name('productos');
    Route::get('/productos/crear', [AdminControlador::class, 'crearProducto'])->name('productos.crear');
    Route::post('/productos', [AdminControlador::class, 'guardarProducto'])->name('productos.guardar');
    Route::get('/productos/{id}/editar', [AdminControlador::class, 'editarProducto'])->name('productos.editar');
    Route::patch('/productos/{id}', [AdminControlador::class, 'actualizarProducto'])->name('productos.actualizar');
    Route::delete('/productos/{id}', [AdminControlador::class, 'eliminarProducto'])->name('productos.eliminar');

    // Gestión de Mascotas (Historial)
    Route::get('/mascotas', [AdminControlador::class, 'mascotas'])->name('mascotas');
    Route::get('/mascotas/{id}', [AdminControlador::class, 'verMascota'])->name('mascotas.ver');
    Route::post('/mascotas/{id}/historial', [AdminControlador::class, 'guardarHistorial'])->name('mascotas.historial');

    // Gestión de Diseño
    Route::get('/diseño', [\App\Http\Controllers\DesignController::class, 'index'])->name('design');
    Route::post('/diseño', [\App\Http\Controllers\DesignController::class, 'update'])->name('design.update');
    Route::delete('/diseño/logo', [\App\Http\Controllers\DesignController::class, 'deleteLogo'])->name('design.logo.delete');
});

// Mascotas (Usuario)
Route::middleware('auth')->group(function () {
    Route::get('/mascotas', [App\Http\Controllers\MascotaController::class, 'index'])->name('mascotas.index');
    Route::get('/mascotas/crear', [App\Http\Controllers\MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [App\Http\Controllers\MascotaController::class, 'store'])->name('mascotas.store');
    Route::delete('/mascotas/{id}', [App\Http\Controllers\MascotaController::class, 'destroy'])->name('mascotas.destroy');

    // Portal Veterinario
    Route::get('/veterinario/dashboard', [App\Http\Controllers\VeterinarioController::class, 'index'])->name('veterinario.index');
    Route::get('/veterinario/citas/{id}', [App\Http\Controllers\VeterinarioController::class, 'show'])->name('veterinario.show');
    Route::patch('/veterinario/citas/{id}', [App\Http\Controllers\VeterinarioController::class, 'update'])->name('veterinario.update');
});


// Ruta del chatbot (POST)
Route::post('/api/chat', [ChatbotControlador::class, 'chat'])->name('chatbot.chat');
Route::get('/test-chat', function () {
    return response()->json(['test' => 'ok']);
});

// Pedidos y Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    // La vista de pedidos ahora está en mi-cuenta
});
