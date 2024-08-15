<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function VentaInventario(){
        return $this->hasMany(VentaInventario::class);
    }
    public function Tesoreria(){
        return $this->hasMany(Tesoreria::class);
    }
    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
    public function Metodo(){
        return $this->belongsTo(Metodo::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    
}