<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionControlador;
use App\Http\Controllers\AppControlador;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\ShopController;

// Páginas Estáticas (Directas a Vista)
Route::view('/', 'inicio')->name('inicio');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');

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
Route::get('/citas/crear', [AppControlador::class, 'crearCita'])->name('citas.crear');
Route::post('/citas', [AppControlador::class, 'guardarCita'])->name('citas.guardar');

// Reseñas
Route::get('/resenas', [AppControlador::class, 'verResenas'])->name('resenas.index');
Route::post('/resenas', [AppControlador::class, 'guardarResena'])->name('resenas.guardar')->middleware('auth');

// ========== PANEL DE ADMINISTRACIÓN ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [AdminControlador::class, 'dashboard'])->name('dashboard');

    // Gestión de Usuarios
    Route::get('/usuarios', [AdminControlador::class, 'usuarios'])->name('usuarios');
    Route::delete('/usuarios/{id}', [AdminControlador::class, 'eliminarUsuario'])->name('usuarios.eliminar');

    // Gestión de Citas
    Route::get('/citas', [AdminControlador::class, 'citas'])->name('citas');
    Route::patch('/citas/{id}/estado', [AdminControlador::class, 'actualizarEstadoCita'])->name('citas.estado');
    Route::delete('/citas/{id}', [AdminControlador::class, 'eliminarCita'])->name('citas.eliminar');

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
});
use App\Http\Controllers\ChatbotControlador;

// Ruta del chatbot (POST)
Route::post('/api/chat', [ChatbotControlador::class, 'chat'])->name('chatbot.chat');
Route::get('/test-chat', function() {
    return response()->json(['test' => 'ok']);
});
