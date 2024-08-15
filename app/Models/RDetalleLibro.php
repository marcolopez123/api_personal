<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RDetalleLibro extends Model
{
    use HasFactory;
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
     public function RLibro(){
        return $this->belongsTo(RLibro::class);
    }
    public function TPeriodoTrabajadore(){
        return $this->belongsTo(TPeriodoTrabajadore::class)->with(['TPPrevisione']);
    }
    
}
