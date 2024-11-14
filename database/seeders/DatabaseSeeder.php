<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {        
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,

            TinacoSeeder::class,
            SensorSeeder::class, 
            SensortinacoSeeder::class,
            LecturaSeeder::class,
        ]);
    }
}
