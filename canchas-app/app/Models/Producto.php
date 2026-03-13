<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre','categoria','stock','precio'];

    public function ventas()
    {
        return $this->hasMany(VentaDespensa::class);
    }
}
