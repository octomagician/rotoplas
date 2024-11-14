<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sensor>
 */
class SensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tipo' => $this->faker->randomElement(['Nivel de Agua', 'Temperatura', 'Humedad', 'pH']),
            'modelo' => 'Modelo ' . $this->faker->word,
            'unidad_medida' => $this->faker->randomElement(['m', '°C', '%', 'pH']),
            'rango_min' => $this->faker->randomFloat(2, 0, 5),
            'rango_max' => $this->faker->randomFloat(2, 5, 10),
        ];
    }
}
