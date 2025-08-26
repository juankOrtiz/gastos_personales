<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
// Importar el trait HasFactory para poder usarlo
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    // Indicar al modelo que puedes usar CategoriaFactory
    use HasFactory;

    protected $guarded = [];
    
    // Relacion con el modelo Transaccion
    // Se llama en plural porque la relacion puede devolver multiples transacciones
    public function transacciones(): HasMany {
        return $this->hasMany(Transaccion::class);
    }
}
