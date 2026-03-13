<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    protected $fillable = ['numero', 'precio_base'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
