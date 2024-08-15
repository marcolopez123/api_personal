<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TImpAutomatico extends Model
{
    use HasFactory;
    public function TipoPagosLegale(){
        return $this->belongsTo(TipoPagosLegale::class);
    }
    public function TipoImpuesto(){
        return $this->belongsTo(TipoImpuesto::class);
    }
    public function TImpuesto(){
        return $this->belongsTo(TImpuesto::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function EProceso(){
        return $this->belongsTo(EProceso::class);
    }
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
}
