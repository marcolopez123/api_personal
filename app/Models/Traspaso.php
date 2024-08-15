<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    use HasFactory;
    public function TraspasoInventario(){
        return $this->hasMany(VentaInventario::class);
    }
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Bodega(){
        return $this->belongsTo(Bodega::class);
    }
}
