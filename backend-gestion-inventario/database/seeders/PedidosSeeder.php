<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('pedidos')->insert([
            'id'=>1,
            'id_usuario'=>1,
            'estado'=>'PENDIENTE',
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('detalle_pedidos')->insert([
            'id'=>1,
            'id_pedido'=>1,
            'id_producto'=>1,
            'cantidad'=>10,
            'created_at'=>date('Y-m-d')
        ]);

        \DB::table('detalle_pedidos')->insert([
            'id'=>2,
            'id_pedido'=>1,
            'id_producto'=>2,
            'cantidad'=>10,
            'created_at'=>date('Y-m-d')
        ]);
    }
}
