<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
// Importar el trait HasFactory para poder usarlo
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{
    // Indicar al modelo que puedes usar CategoriaFactory
    use SoftDeletes, HasFactory;
    
    // Indicar a Laravel que la tabla relacionada se llama transacciones
    protected $table = 'transacciones';

    // Permitir usar create() para crear una transaccion
    protected $guarded = [];

    // Relacion con el modelo Categoria
    // Se llama en singular porque la relacion devuelve siempre 1 categoria
    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
}
