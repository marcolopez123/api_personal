<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;
     public function LiquidacionDoctos(){
        return $this->hasMany(LiquidacionDocto::class)->with(['documento'])->where('estado',1)->orderBy('id','desc');
    }
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
    public function Ano(){
        return $this->belongsTo(Ano::class);
    } 
    public function Mese(){
        return $this->belongsTo(Mese::class);
    }
}
