<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function PedidoDetalle(){
        return $this->hasMany(PedidoDetalle::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
}
