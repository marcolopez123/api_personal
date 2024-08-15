<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respaldo extends Model
{
    use HasFactory;
    use HasFactory;
    public function RespaldoDoctos(){
        return $this->hasMany(RespaldoDocto::class)->with(['documento'])->where('estado',1)->orderBy('id','desc');
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function TipoArchivo(){
        return $this->belongsTo(TipoArchivo::class);
    }
}
