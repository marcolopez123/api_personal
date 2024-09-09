<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SGuardia extends Model
{
    use HasFactory;
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

}
