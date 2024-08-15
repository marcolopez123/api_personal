<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaInventario extends Model
{
    use HasFactory;
    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
    public function Impuesto(){
        return $this->belongsTo(Impuesto::class);
    }
    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
    public function Cetegoria(){
        return $this->belongsTo(Categoria::class);
    }
}
