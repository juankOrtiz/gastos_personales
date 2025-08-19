<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $guarded = [];
    
    // Relacion con el modelo Transaccion
    // Se llama en plural porque la relacion puede devolver multiples transacciones
    public function transacciones(): HasMany {
        return $this->hasMany(Transaccion::class);
    }
}
