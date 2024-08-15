<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacione extends Model
{
    use HasFactory;

    public function Pais(){
        return $this->belongsTo(Pais::class);
    }
    public function T_estado_pago(){
        return $this->belongsTo(T_estado_pago::class);
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
