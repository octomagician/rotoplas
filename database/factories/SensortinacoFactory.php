<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tinaco;
use App\Models\Sensor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sensor>
 */
class SensortinacoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sensor_id' => Sensor::inRandomOrder()->first()->id,
            'tinaco_id' => Tinaco::inRandomOrder()->first()->id,
        ];
    }
}
