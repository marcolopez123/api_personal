<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use App\Models\Inventario;
use App\Models\Trabajador;
use App\Models\Facturacione;
use App\Models\User;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function info(Request $request){
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        return [
            
            "ctrabajadores"=>Trabajador::where('estado',1)->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->get()->sum('estado'),
            "dclientes"=>Facturacione::where('t_estado_pago_id',1)->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->get()->sum('monto'),
            
        ];
        

    }
   
}
