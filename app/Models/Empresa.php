<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
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
    public function FamiliaCentro(){
        return $this->belongsTo(FamiliaCentro::class);
    }
    public function Centro(){
        return $this->belongsTo(Centro::class);
    }
    public function UserEmpresa(){
        return $this->belongsTo(UserEmpresa::class);
    }
    public function UserSucursal(){
        return $this->belongsTo(UserSucursal::class);
    }
    
}
