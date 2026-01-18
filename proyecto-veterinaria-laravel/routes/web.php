<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionControlador;
use App\Http\Controllers\AppControlador;

// Páginas Estáticas (Directas a Vista)
Route::view('/', 'inicio')->name('inicio');
Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/contacto', 'contacto')->name('contacto');

// Autenticación (Mismo método maneja GET y POST si quieres, pero separado es más claro)
Route::match(['get', 'post'], '/login', [AutenticacionControlador::class, 'login'])->name('login');
Route::match(['get', 'post'], '/registro', [AutenticacionControlador::class, 'registro'])->name('registro');
Route::post('/logout', [AutenticacionControlador::class, 'logout'])->name('logout');

// Citas
Route::get('/citas/crear', [AppControlador::class, 'crearCita'])->name('citas.crear');
Route::post('/citas', [AppControlador::class, 'guardarCita'])->name('citas.guardar');

// Reseñas
Route::get('/resenas', [AppControlador::class, 'verResenas'])->name('resenas.index');
Route::post('/resenas', [AppControlador::class, 'guardarResena'])->name('resenas.guardar')->middleware('auth');

// Chat (Opcional, si queremos mantenerlo simple podemos quitarlo o dejarlo como mock en JS)
// Route::post('/chat', ...); 
