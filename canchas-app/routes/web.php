<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaDespensaController;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\PublicController;

// ─────────────────────────────────────────────
// RUTAS PÚBLICAS —
// ─────────────────────────────────────────────

// Landing Page
Route::get('/', [PublicController::class, 'index'])->name('landing');

// API: horarios ocupados (llamada AJAX desde el frontend)
Route::get('/api/horarios-disponibles', [PublicController::class, 'getHorariosDisponibles'])
    ->name('api.horarios');

// Procesar reserva pública
Route::post('/reservar', [PublicController::class, 'storeReserva'])->name('reserva.publica.store');

Route::get('/profile', function () { return "Página de perfil en construcción"; })->name('profile.edit');


// ─────────────────────────────────────────────
// RUTAS PRIVADAS
// ─────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [FinanzasController::class, 'index'])->name('dashboard');
    Route::resource('canchas', CanchaController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas-despensa', VentaDespensaController::class);
    Route::get('/finanzas/reporte', [FinanzasController::class, 'reporte'])->name('finanzas.reporte');
});

require __DIR__.'/auth.php';