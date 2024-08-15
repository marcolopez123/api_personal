<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TGRemuneracione extends Model
{
    use HasFactory;
    public function TPRemuneracione(){
        return $this->belongsTo(TPRemuneracione::class);
    }
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    }
    public function TTarea(){
        return $this->belongsTo(TTarea::class);
    }
}
