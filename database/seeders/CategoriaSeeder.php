<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creacion de una categoria normal
        Categoria::create([
            'nombre' => 'Salario',
            'tipo' => 'ingreso',
        ]);

        // Usar el factory para crear 10 categorias al azar
        Categoria::factory()->count(10)->create();
    }
}
