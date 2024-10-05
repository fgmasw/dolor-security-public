<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta del dashboard (panel de control)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas con middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Rutas de perfil de usuario (ya existentes)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de pacientes
    // Ruta para obtener los pacientes eliminados (soft deleted)
    Route::get('pacientes/trashed', [PacienteController::class, 'trashed'])->name('pacientes.trashed');

    // Rutas para los recursos de pacientes
    Route::resource('pacientes', PacienteController::class);

    // Ruta para terminar el tratamiento de un paciente
    Route::put('pacientes/{id}/terminar-tratamiento', [PacienteController::class, 'terminarTratamiento'])->name('pacientes.terminarTratamiento');

    // Ruta para restaurar un paciente eliminado
    Route::patch('pacientes/{id}/restore', [PacienteController::class, 'restore'])->name('pacientes.restore');

    // Ruta para eliminar permanentemente un paciente
    Route::delete('pacientes/{id}/force-delete', [PacienteController::class, 'forceDelete'])->name('pacientes.forceDelete');
});

require __DIR__.'/auth.php';
