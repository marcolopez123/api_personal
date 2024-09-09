<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function TipoArchivo(){
        return $this->belongsTo(TipoArchivo::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
}
