<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
    use HasFactory;
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
    public function Tesoreria(){
        return $this->belongsTo(Tesoreria::class);
    }
}
