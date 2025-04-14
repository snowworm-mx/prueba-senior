<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'id_usuario','id');
    }

    public function detallePedidos(){
        return $this->hasMany(DetallePedido::class,'id_pedido','id');
    }
}
