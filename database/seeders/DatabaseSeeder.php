<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'username'   => 'Administrador',
            'user'   => 'administrador',
            'email'     => 'administrador@gmail.com',
            'password'      => bcrypt('12345678'),
            'rol_id' => '1',
            'state' => '1',
         ]);//Incriptamos la contrase;a
        \App\Models\User::create([
            'username'   => 'Tecate',
            'user'   => 'AY001-TEC',
            'email'     => 'tecate@gmail.com',
            'password'      => bcrypt('12345678'),
            'number_user' => '220115',
            'rol_id' => '2',
            'state' => '1',
            'slug' => 'Tecate',
        ]);//Incriptamos la contrase;a
        \App\Models\Role::create([
            'name'   => 'Administrador',
        ]);
        \App\Models\Role::create([
            'name'   => 'Sujeto obligado',
        ]);
    }

}
