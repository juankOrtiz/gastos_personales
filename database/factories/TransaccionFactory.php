<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaccion>
 */
class TransaccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => fake()->sentence(),
            'monto' => fake()->randomFloat(5, 10000, 100000),
            'fecha_transaccion'=> fake()->date(),
            'categoria_id' => Categoria::factory(),
            // 'grupo_id' => 1,
        ];
    }
}
