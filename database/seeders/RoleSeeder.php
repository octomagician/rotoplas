<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $guest = Role::create(['name' => 'Guest']);
        $user = Role::create(['name' => 'User']);
        $admin = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'ver perfil']);
        Permission::create(['name' => 'editar perfil']);
        Permission::create(['name' => 'subir foto de perfil']);

        $user->givePermissionTo(['ver perfil', 'editar perfil', 'subir foto de perfil']);
        $admin->givePermissionTo(Permission::all());

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('administrador');
    }

}
