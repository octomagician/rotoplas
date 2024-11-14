<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lectura;
use App\Models\Sensortinaco;


class LecturaSeeder extends Seeder
{
    public function run()
    {
        $sensorTinacos = SensorTinaco::all();
    
        foreach ($sensorTinacos as $sensorTinaco) {
            // Cada SensorTinaco tendrá al menos 1 Lectura
            Lectura::factory(1)->create([
                'sensortinaco_id' => $sensorTinaco->id,
            ]);
        }
    
        // Si quieres agregar más lecturas aleatorias para algunos registros, puedes hacerlo así:
        // Agregar algunas lecturas extra (ejemplo: 300 en total)
        $lecturasExtra = 300 - count($sensorTinacos); // Ya hemos creado una por cada SensorTinaco
        foreach (range(1, $lecturasExtra) as $index) {
            // Seleccionamos un sensor_tinaco aleatorio y le agregamos una lectura extra
            $sensorTinaco = $sensorTinacos->random();
            Lectura::factory(1)->create([
                'sensortinaco_id' => $sensorTinaco->id,
            ]);
        }
    }
}
