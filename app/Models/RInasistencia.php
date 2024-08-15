<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RInasistencia extends Model
{
    use HasFactory;
    public function RTipoInasistencia(){
        return $this->belongsTo(RTipoInasistencia::class);
    }
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
}
