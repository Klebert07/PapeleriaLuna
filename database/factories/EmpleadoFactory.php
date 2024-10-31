<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'puesto' => fake()->jobTitle(),
            'telefono' => fake()->phoneNumber(), // Cambiado para generar números de teléfono con formato
        ];
    }
}
