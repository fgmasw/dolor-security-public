<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

// Ruta principal que carga la vista home.blade.php y se nombra 'home'
Route::get('/', function () {
    return view('home');
})->name('home');

// Ruta para la guía en video
Route::get('/guia/video', function () {
    return view('guia.video'); // Asegúrate de que exista la vista 'guia/video.blade.php'
})->name('guia.video');

// Ruta del dashboard sin controlador, pero protegida por autenticación
Route::get('/dashboard', function () {
    return view('dashboard'); // Carga directamente la vista del dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas con middleware 'auth'
Route::middleware(['auth'])->group(function () {

    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para los recursos de pacientes
    Route::resource('pacientes', PacienteController::class);

    // Rutas adicionales relacionadas con pacientes
    Route::get('pacientes/trashed', [PacienteController::class, 'trashed'])->name('pacientes.trashed');
    Route::put('pacientes/{id}/terminar-tratamiento', [PacienteController::class, 'terminarTratamiento'])->name('pacientes.terminarTratamiento');
    Route::patch('pacientes/{id}/restore', [PacienteController::class, 'restore'])->name('pacientes.restore');
    Route::delete('pacientes/{id}/force-delete', [PacienteController::class, 'forceDelete'])->name('pacientes.forceDelete');
});

// Rutas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta para la vista de prueba
Route::get('/test', function () {
    return view('test'); // Asegúrate de que 'test' sea el nombre del archivo sin la extensión .blade.php
})->name('test');

// Requerir las rutas de autenticación ya generadas
require __DIR__.'/auth.php';
