<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDespensa extends Model
{
    protected $fillable = ['producto_id', 'cantidad', 'total_venta', 'metodo_pago'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
