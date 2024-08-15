<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    public function Pais(){
        return $this->belongsTo(Pais::class);
    }
    public function Region(){
        return $this->belongsTo(Region::class);
    }
    public function Comuna(){
        return $this->belongsTo(Comuna::class);
    }
    public function Ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function UserSucursal(){
        return $this->belongsTo(UserSucursal::class);
    }
}
