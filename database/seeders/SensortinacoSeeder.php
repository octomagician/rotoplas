<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tinaco;
use App\Models\Sensor;

class SensortinacoSeeder extends Seeder
{
    public function run()
    {
        $tinacos = Tinaco::all();
        $sensores = Sensor::all();
    
        // Crear 75 registros en la tabla intermedia sensor_tinaco
        foreach ($tinacos as $tinaco) {
            foreach ($sensores as $sensor) {
                $tinaco->sensors()->attach($sensor->id);
            }
        }
    }
}
