<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TGHonorario extends Model
{
    use HasFactory;
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
    public function TTipoHonorario(){
        return $this->belongsTo(TTipoHonorario::class);
    }
}
