<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public function Pais(){
        return $this->belongsTo(Pais::class);
    }
    use HasFactory;
    public function Comunas(){
        return $this->hasMany(Comuna::class);
    }
    
}
