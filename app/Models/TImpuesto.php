<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TImpuesto extends Model
{
    use HasFactory;
    public function TipoPagosLegale(){
        return $this->belongsTo(TipoPagosLegale::class);
    }
    public function TipoImpuesto(){
        return $this->belongsTo(TipoImpuesto::class);
    }
}
