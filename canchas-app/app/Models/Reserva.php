<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'cancha_id', 'fecha_reserva', 'horario_inicio', 'horario_fin',
        'cliente_nombre', 'estado_reserva', 'precio_total',
        'monto_senia', 'metodo_pago', 'estado_pago'
    ];

    protected $casts = [
        'fecha_reserva' => 'date',
        'precio_total'  => 'decimal:2',
        'monto_senia'   => 'decimal:2',
    ];

    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }

    public function getSaldoRestanteAttribute()
    {
        return $this->precio_total - $this->monto_senia;
    }
}