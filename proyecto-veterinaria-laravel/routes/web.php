<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionControlador;
use App\Http\Controllers\AppControlador;
use App\Http\Controllers\AdminControlador;

// PÃ¡ginas EstÃ¡ticas (Directas a Vista)
Route::view('/', 'inicio')->name('inicio');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');

// AutenticaciÃ³n - Rutas separadas para GET y POST
Route::get('/login', [AutenticacionControlador::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AutenticacionControlador::class, 'login'])->name('login.post');
Route::get('/registro', [AutenticacionControlador::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [AutenticacionControlador::class, 'registro'])->name('registro.post');
Route::post('/logout', [AutenticacionControlador::class, 'logout'])->name('logout');

// Citas
Route::get('/citas/crear', [AppControlador::class, 'crearCita'])->name('citas.crear');
Route::post('/citas', [AppControlador::class, 'guardarCita'])->name('citas.guardar');

// ReseÃ±as
Route::get('/resenas', [AppControlador::class, 'verResenas'])->name('resenas.index');
Route::post('/resenas', [AppControlador::class, 'guardarResena'])->name('resenas.guardar')->middleware('auth');

// Chat (Opcional, si queremos mantenerlo simple podemos quitarlo o dejarlo como mock en JS)
// Route::post('/chat', ...); 

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
});
