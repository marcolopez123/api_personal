<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    public function CompraInventario(){
        return $this->hasMany(CompraInventario::class);
    }
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Metodo(){
        return $this->belongsTo(Metodo::class);
    }
    public function Proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
    
}
