<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        User::truncate();

        //Crear usuario para las apis
        $password = Hash::make('soporte1');

        User::create([
            'name' => 'Usuario Test',
            'email' => 'admin@pruebas.com',
            'password' => $password
        ]);
    }
}
