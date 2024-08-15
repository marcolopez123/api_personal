<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    public function ArchivoDoctos(){
        return $this->hasMany(ArchivoDocto::class)->with(['documento'])->where('estado',1)->orderBy('id','desc');
    }
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function TipoArchivo(){
        return $this->belongsTo(TipoArchivo::class);
    }
    
}
