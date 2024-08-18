<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RCAsistencia extends Model
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
}
