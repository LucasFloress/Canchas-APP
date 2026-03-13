<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaDespensaController;
use App\Http\Controllers\FinanzasController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/profile', function () { return "Página de perfil en construcción"; })->name('profile.edit');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [FinanzasController::class, 'index'])->name('dashboard');
    Route::resource('canchas', CanchaController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas-despensa', VentaDespensaController::class);
    Route::get('/finanzas/reporte', [FinanzasController::class, 'reporte'])->name('finanzas.reporte');
});

require __DIR__.'/auth.php';