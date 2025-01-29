<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('productos')->insert([
            'nombre'=>'Coca-cola 2lt',
            'descripcion'=>'refresco retornable de 2 litros',
            'precio'=>40.0,
            'cantidad'=>10,
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('productos')->insert([
            'nombre'=>'Pinguinos',
            'descripcion'=>'pastelito de chocolate 2 piezas',
            'precio'=>23.0,
            'cantidad'=>10,
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('productos')->insert([
            'nombre'=>'Pan blanco Bimbo',
            'descripcion'=>'pan blanco 30 piezas',
            'precio'=>45.0,
            'cantidad'=>3,
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('productos')->insert([
            'nombre'=>'Sabritas 40gr',
            'descripcion'=>'Sabritas 40gr',
            'precio'=>20.0,
            'cantidad'=>3,
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('productos')->insert([
            'nombre'=>'Marias 40gr',
            'descripcion'=>'Marias 40gr',
            'precio'=>18.0,
            'cantidad'=>3,
            'created_at'=>date('Y-m-d')
        ]);
    }
}
