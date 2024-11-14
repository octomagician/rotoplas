<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tinaco>
 */
class TinacoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => 'Tinaco ' . $this->faker->word,
            'ubicacion' => $this->faker->address,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
