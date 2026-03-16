<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cancha extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'precio_base'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}