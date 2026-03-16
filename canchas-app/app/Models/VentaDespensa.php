<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaDespensa extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'cantidad', 'total_venta', 'metodo_pago'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}