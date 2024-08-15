<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPeriodoTrabajadore extends Model
{
    use HasFactory;
    public function TPeriodo(){
        return $this->belongsTo(TPeriodo::class);
    } 
    public function Trabajador(){
        return $this->belongsTo(Trabajador::class);
    } 
    public function TPrevisione(){
        return $this->belongsTo(TPrevisione::class);
    } 
    public function TPPrevisione(){
        return $this->belongsTo(TPPrevisione::class);
    } 
    public function TSalude(){
        return $this->belongsTo(TSalude::class);
    } 
    public function Empresa(){
        return $this->belongsTo(Empresa::class);
    } 
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function RContrato(){
        return $this->belongsTo(RContrato::class)->with(['RDocContrato'])->with(['RTipoContrato'])->where('estado',1)->orderBy('id','desc');
    }
}
