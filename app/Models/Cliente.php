<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
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
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
    public function Tesoreria(){
        return $this->hasMany(Tesoreria::class);
    }
    public function Facturacione(){
        return $this->hasMany(Facturacione::class);
    }
}
