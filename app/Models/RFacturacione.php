<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFacturacione extends Model
{
    use HasFactory;
    public function RespaldoFacturacione(){
        return $this->hasMany(RespaldoFacturacione::class)->with(['documento'])->where('estado',1)->orderBy('id','desc');
    }
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function TipoArchivo(){
        return $this->belongsTo(TipoArchivo::class);
    }
}
