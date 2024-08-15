<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;

    public function Pedido(){
        return $this->belongsTo(Pedido::class);
    }
    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
    public function Bodega(){
        return $this->belongsTo(Bodega::class);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function Medida(){
        return $this->belongsTo(Medida::class);
    }
    public function Marca(){
        return $this->belongsTo(Marca::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Impuesto(){
        return $this->belongsTo(Impuesto::class);
    }
}
