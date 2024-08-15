<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RContrato extends Model
{
    use HasFactory;
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function RTipoContrato(){
        return $this->belongsTo(RTipoContrato::class);
    }
    public function RDocContrato(){
        return $this->belongsTo(RDocContrato::class);
    }
}
