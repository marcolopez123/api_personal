<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesoreria extends Model
{
    use HasFactory;

    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
    public function Metodo(){
        return $this->belongsTo(Metodo::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    
    
}
