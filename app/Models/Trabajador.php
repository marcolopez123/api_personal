<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;
    public function Pais(){
        return $this->belongsTo(Pais::class);
    }
    public function Region(){
        return $this->belongsTo(Region::class);
    }
    public function Comuna(){
        return $this->belongsTo(Comuna::class);
    }
    public function Ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function TNacionalidade(){
        return $this->belongsTo(TNacionalidade::class);
    }
    public function TSexo(){
        return $this->belongsTo(TSexo::class);
    }
    public function TEstadoCivile(){
        return $this->belongsTo(TEstadoCivile::class);
    }
    public function FichaImages(){
        return $this->hasMany(FichaImage::class)->with(['image'])->where('estado',1)->orderBy('id','desc');
    }
}
