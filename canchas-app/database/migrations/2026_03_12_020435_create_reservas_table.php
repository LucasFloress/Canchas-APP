<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cancha_id')->constrained('canchas')->onDelete('restrict');
            $table->date('fecha_reserva');
            $table->time('horario_inicio');
            $table->time('horario_fin');
            $table->string('cliente_nombre');
            $table->enum('estado_reserva', ['disponible','reservado','cancelado', 'completado'])->default('reservado');
            $table->decimal('precio_total',10,2);
            $table->decimal('monto_senia', 10, 2)->default(0);
            $table->string('metodo_pago')->nullable();
            $table->enum('estado_pago', ['pendiente', 'senia_pagada', 'pagado'])->default('pendiente');
            $table->timestamps();
        });
    }                          

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
