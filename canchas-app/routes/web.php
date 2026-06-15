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

// ─────────────────────────────────────────────
// RUTAS DE ADMIN
// ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Rutas solo para admins NO autenticados
    Route::middleware('guest:admin')->group(function () {
        Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);

        Route::get('forgot-password',        [PasswordController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password',       [PasswordController::class, 'sendResetLink'])->name('password.email');
        Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password',        [PasswordController::class, 'resetPassword'])->name('password.update');
    });

    // Rutas solo para admins autenticados
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    });
});

// ─────────────────────────────────────────────
// RUTA LOGIN
// ─────────────────────────────────────────────
Route::get("/login", [AuthenticatedSessionController::class, 'create'])->name("auth.login");


require __DIR__.'/auth.php';