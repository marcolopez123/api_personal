<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPeriodo extends Model
{
    use HasFactory;
    public function Ano(){
        return $this->belongsTo(Ano::class);
    } 
    public function Mese(){
        return $this->belongsTo(Mese::class);
    }
}
