<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidacionDocto extends Model
{
    use HasFactory;

    public function Documento(){
        return $this->belongsTo(Documento::class);
    }
}
