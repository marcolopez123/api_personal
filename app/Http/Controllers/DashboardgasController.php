<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\VentaInventario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardgasController extends Controller
{
    public function info(){
        return [

            //"articulos"=>Articulo::where('estado',1)->get()->count(),
           // "usuarios"=>User::where('estado',1)->get()->count(),
           // "clientes"=>Cliente::where('estado',1)->where('id','<>',21)->where('id','<>',22)->where('id','<>',23)->get()->sum('deuda'),
            //"ventas"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('bodega_id','<>',3)->where('bodega_id','<>',4)->where('bodega_id','<>',5)->get()->sum('total')/1000,
           // "vcentro"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',21)->get()->sum('total')/1000,
           // "vjp"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',22)->get()->sum('total')/1000,
            "ventas"=>Inventario::where('estado',1)->where('tipo',2)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('bodega_id','<>',1)->where('bodega_id','<>',2)->get()->sum('cantidad'), 
            "compras"=>Compra::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('sucursal_id','=',1)->get()->sum('cantidad'),
            "articulo"=>Articulo::where('estado',1)->where('bodega_id',3)->get(),
            "bodega2"=>Articulo::where('estado',1)->where('bodega_id',7)->where('nombre','<>','descuento verde')->get(),
            "camion1"=>Articulo::where('estado',1)->where('bodega_id',4)->where('nombre','<>','descuento verde')->get(),
            "camion2"=>Articulo::where('estado',1)->where('bodega_id',5)->where('nombre','<>','descuento verde')->get(),
            "camion3"=>Articulo::where('estado',1)->where('bodega_id',6)->get(),
          //  "utilidad"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('total')/1000-Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_compra')/1000,
            //"centro"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',21)->get()->sum('total')/1000-Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',21)->get()->sum('t_compra')/1000,
          //  "pcentro"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',21)->get()->sum('total')/Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',21)->get()->sum('t_compra')*100-100,
           // "jp"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',22)->get()->sum('total')/1000-Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',22)->get()->sum('t_compra')/1000,
          //  "pjp"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',22)->get()->sum('total')/Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id',22)->get()->sum('t_compra')*100-100,
            //"diego"=>Venta::where('estado',1)->where('cliente_id',23)->get()->sum('total')/1000-Venta::where('estado',1)->where('cliente_id',23)->get()->sum('t_compra')/1000,
            //"porutilidad"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('total')/Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('cliente_id','<>',21)->where('cliente_id','<>',22)->where('cliente_id','<>',23)->get()->sum('t_compra')*100-100,
            "meses"=>$this->VentaMes()->sum('venta'),
            "mes"=>Venta::where('estado',1)->whereRaw('month(fecha) = month(now())')->whereRaw('year(fecha) = year(now())')->where('sucursal_id','<>',1)->get()->sum('total'),
            "cmeses"=>$this->ComprasMensual(),
            //"ainventario"=>$this->Carticulos(),
            //"diaventa"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('total'),
            //"diacosto"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_compra'),
            //"diautilidad"=>Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('total') - Venta::where('estado',1)->whereDate('fecha', '=', now())->get()->sum('t_compra'),
            
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
        $ventas= Inventario::select(
            DB::raw('sum(kilos) as venta','*', 'sum(cantidad) as venta'),
        )
        ->where('bodega_id','<>',1)
        ->where('bodega_id','<>',2)
        ->where('estado',1)
        ->where('tipo',2)
        ->whereRaw('month(fecha) = month(now())')
        ->whereRaw('year(fecha) = year(now())')
        ->groupBy('fecha')
        ->get();
        return $ventas;
    }
    public function VentasMensual(){

        $ventas= Inventario::select(
            DB::raw('sum(cantidad) as total'),
            DB::raw("DATE_FORMAT(fecha,'%M %Y') as mes")
        )
        ->where('estado',1)
        ->where('bodega_id',1)
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

        $model= Articulo::where('bodega_id','=',4)->where('estado',1)->get();
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
        $articulo->egresos = $articulo->inventarios->where('tipo',2)->sum('cantidad');
        $articulo->kilos = $articulo->egresos * $articulo->peso;
        return $articulo;
    }
}
