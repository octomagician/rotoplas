<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sensortinaco;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lectura>
 */
class LecturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sensortinaco_id' => SensorTinaco::inRandomOrder()->first()->id,
            'valor' => $this->faker->randomFloat(2, 0, 10),
            'timestamp' => now(),
        ];
    }
}
