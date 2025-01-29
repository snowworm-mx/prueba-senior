<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    public function pedido()
    {
        return $this->belognsTo(Pedido::class,'id_pedido','id');
    }

    public function producto(){
        return $this->hasOne(Producto::class,'id','id_producto');
    }
}
