<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name'=>'Jose Garcia',
            'email'=>'jose@correo.com',
            'password'=>Hash::make('12345678'),
            'rol'=>'admin',
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('users')->insert([
            'name'=>'Alexis Ortega',
            'email'=>'alexis@correo.com',
            'password'=>Hash::make('12345678'),
            'rol'=>'user',
            'created_at'=>date('Y-m-d')
        ]);
    }
}
