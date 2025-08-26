<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaccion;
use App\Models\Categoria;

class TransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer las categoria existentes
        $idsCategoria = Categoria::pluck('id');
        
        Transaccion::factory()->count(100)->create([
            // Asignar a categoria_id uno de los ID existentes en la tabla categorias
            'categoria_id' => function() use ($idsCategoria) {
                return fake()->randomElement($idsCategoria);
            }
        ]);
    }
}
