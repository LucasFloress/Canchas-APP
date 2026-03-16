<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'categoria', 'stock', 'precio'];

    public function ventas()
    {
        return $this->hasMany(VentaDespensa::class);
    }
}