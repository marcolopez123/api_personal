<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SControle extends Model
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
    public function SCentro(){
        return $this->belongsTo(SCentro::class);
    }
}
