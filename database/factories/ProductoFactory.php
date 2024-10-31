<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Removemos el id ya que Laravel lo asignará automáticamente
            'nombre' => fake()->name(),
            'descripcion' => fake()->sentence(),  // mejor usar sentence para descripción
            'categoria' => fake()->word(),        // word para categoría
            'precio' => fake()->numberBetween(100, 10000), // rango de precios más realista
        ];
    }
}