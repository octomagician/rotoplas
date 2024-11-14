<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sensor;

class SensorSeeder extends Seeder
{
    public function run()
    {
        Sensor::factory()->create([
            'tipo' => 'PH',
            'modelo' => '###',
            'unidad_medida' => 'pH',
            'rango_min' => '0',
            'rango_max' => '14'
        ]);

        Sensor::factory()->create([
            'tipo' => 'Ultrasonido',
            'modelo' => '###',
            'unidad_medida' => 'cm',
            'rango_min' => '0',
            'rango_max' => '100' //cambiar según la documentación
        ]);

        Sensor::factory()->create([
            'tipo' => 'Temperatura',
            'modelo' => '###',
            'unidad_medida' => 'C°',
            'rango_min' => '0',
            'rango_max' => '80' //cambiar según la documentación
        ]);
    }
}
