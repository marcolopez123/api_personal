<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RLibro extends Model
{
    use HasFactory;
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
