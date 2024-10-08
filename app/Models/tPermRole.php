<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tPermRole extends Model
{
    use HasFactory;
    
    public function Role(){
        return $this->belongsTo(Role::class);
    }
    public function Menu(){
        return $this->belongsTo(Menu::class);
    }

}
