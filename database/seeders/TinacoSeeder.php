<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tinaco;
use App\Models\User;

class TinacoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();

        // Creamos 15 tinacos, cada uno asignado a un usuario aleatorio
        Tinaco::factory(15)->create()->each(function ($tinaco) use ($users) {
            $tinaco->user()->associate($users->random())->save();
        });
    }
}
