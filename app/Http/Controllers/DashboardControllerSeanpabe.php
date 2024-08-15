<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function info(){
        return [

            "articulos"=>Articulo::where('estado',1)->get()->count(),
            "usuarios"=>User::where('estado',1)->get()->count(),
            "clientes"=>Cliente::where('estado',1)->where('id','<>',21)->where('id','<>',22)->where('id','<>',23)->get()->sum('deuda'),
            "ventas"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_neto')/1000,
            "compras"=>Compra::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->get()->sum('t_neto')/1000,
            "clientesd"=>Cliente::where('estado',1)->where('deuda','<>',0)->get(),
            "utilidad"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_neto')/1000-Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_compra')/1000,
            "porutilidad"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_neto')/Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_compra')*100-100,
            "meses"=>$this->VentasMensual(),
            "mes"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->get()->sum('t_neto'),
            "cmeses"=>$this->ComprasMensual(),
            "ainventario"=>$this->Carticulos(),
            "diaventa"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_neto'),
            "diacosto"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_compra'),
            "diautilidad"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_neto') - Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_compra'),
            
        ];
        

    }
    public function resumenDia()
    {
        $ventas= Venta::select(
            DB::raw('sum(total) as venta'),
        )
        ->where('estado',1)
        ->whereDate('fecha', '=', now())
        ->groupBy('fecha')
        ->get();
        return $ventas;
    }
    public function VentaMes()
    {
        $ventas= Venta::select(
            DB::raw('sum(total) as venta'),
        )
        ->where('estado',1)
        ->whereDate('fecha', '=', now())
        ->groupBy('fecha')
        ->get();
        return $ventas;
    }
    public function VentasMensual(){

        $ventas= Venta::select(
            DB::raw('sum(total) as total'),
            DB::raw("DATE_FORMAT(fecha,'%M %Y') as mes")
        )
        ->where('estado',1)
        ->groupBy('mes')
        ->get();
        return $ventas;
    }
    public function ComprasMensual(){

        $compras= Compra::select(
            DB::raw('sum(total) as total'),
            DB::raw("DATE_FORMAT(fecha,'%M %Y') as mes")
        )
        ->where('estado',1)
        ->groupBy('mes')
        ->get();
        return $compras;
    }
    public function Carticulos(){

        $model= Articulo::where('stock','>',0)->where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->kardex($m);
        }
        return $list;
        
    }
    public function Kardex(Articulo $articulo)
    {
        

        $articulo->marca = $articulo->Marca;
        $articulo->marca = $articulo->Marca;
        $articulo->medida = $articulo->Medida;
        $articulo->bodega = $articulo->Bodega;
        $articulo->categoria = $articulo->Categoria;
        $articulo->inventarios = $articulo->Inventarios()->where('estado',1)->get();
        $articulo->ingresos = $articulo->inventarios->where('tipo',1)->sum('cantidad');
        $articulo->egresos = $articulo->inventarios->where('tipo',2)->sum('cantidad');
        $articulo->stock = $articulo->ingresos - $articulo->egresos;
        $articulo->valorizado = $articulo->stock * $articulo->venta;
        $articulo->inversion = $articulo->stock * $articulo->compra;
        $articulo->ganancia = $articulo->valorizado - $articulo->inversion;
        return $articulo;
    }
}
