<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VentaDespensaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\PasswordController;
use Illuminate\Auth\Middleware\Authenticate;

// ─────────────────────────────────────────────
// RUTAS PÚBLICAS
// ─────────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('landing');
Route::get('/api/horarios-disponibles', [PublicController::class, 'getHorariosDisponibles'])->name('api.horarios');
Route::post('/reservar', [PublicController::class, 'storeReserva'])->name('reserva.publica.store');
Route::get('/profile', function () { return "Página de perfil en construcción"; })->name('profile.edit');

// ─────────────────────────────────────────────
// RUTAS DE ADMIN (Protegidas)
// ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // 1. Admins NO autenticados (Login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');

        Route::get('forgot-password',        [PasswordController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password',       [PasswordController::class, 'sendResetLink'])->name('password.email');
        Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password',        [PasswordController::class, 'resetPassword'])->name('password.update');
    });

    // 2. Admins AUTENTICADOS (El Panel)
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        
        // Esta es la ruta que Laravel no encontraba:
        Route::get('dashboard', [FinanzasController::class, 'index'])->name('dashboard');
        
        // Gestión de recursos
        Route::resource('canchas', CanchaController::class);
        Route::resource('reservas', ReservaController::class);
        Route::resource('productos', ProductoController::class);
        Route::resource('ventas-despensa', VentaDespensaController::class);
        Route::get('/finanzas/reporte', [FinanzasController::class, 'reporte'])->name('finanzas.reporte');
    });
});

// ─────────────────────────────────────────────
// RUTA LOGIN POR DEFECTO
// ─────────────────────────────────────────────
Route::get("/login", [AuthenticatedSessionController::class, 'create'])->name("auth.login");

require __DIR__.'/auth.php';