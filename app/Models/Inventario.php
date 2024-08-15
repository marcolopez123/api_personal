<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    public function Articulo(){
        return $this->belongsTo(Articulo::class);
    }
    public function Bodega(){
        return $this->belongsTo(Bodega::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Impuesto(){
        return $this->belongsTo(Impuesto::class);
    }
}
