<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Articulo;
use App\Models\VentaInventario;
use App\Models\Tesoreria;
use App\Models\Inventario;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fecha1 = $request->fecha1;

        if ($fecha1==''){
        $venta = Venta::whereDate('fecha', '=' , now())->where('estado',1)->with(['Documento','Metodo','Cliente'])->get();
        
        
        $list=[];
        foreach($venta as $m){
            $list[]=$this->show($m);
        }
     
    }
    else{
        $venta = Venta::orderBy('fecha','desc')->where('fecha', '>=' , $request->fecha1)->where('fecha', '<=' , $request->fecha2)->where('estado',1)->with(['Documento','Metodo','Cliente'])->get();
        
        $list=[];
        foreach($venta as $m){
            $list[]=$this->show($m);
        }
       
    }
        return $list;
    }
    public function filter(Request $request)
    {   
        $start_date =$request->start_date;

        $venta = Venta::orderBy('fecha','desc')->whereDate('fecha','=',$start_date)->where('estado',1)->with(['Documento','Metodo','Cliente'])->get();
        
        $list=[];
        foreach($venta as $m){
            $list[]=$this->show($m);
        }
        return $list;
    }
    public function resumenVentas()
    {
        $ventas= Venta::select(
            
            DB::raw('fecha'),
            'usuario_id',
            DB::raw('sum(total) as venta'),
        )
        ->where('estado',1)
        ->groupBy('fecha')
        ->groupBy('usuario_id')
        ->get();
        return $ventas;
    }

    public function resumenDia()
    {
        $ventas= Venta::select(
            DB::raw('fecha'),
            DB::raw('sum(t_compra) as costo'),
            DB::raw('sum(total) as venta'),
            DB::raw('sum(total)-sum(t_compra) as utilidad'),
        )
        ->where('estado',1)
        ->whereDate('fecha', '=', now())
        ->groupBy('fecha')
        ->get();
        return $ventas;
    }
    public function ventasCliente(Request $request)
    {
        $ventas= Venta::select(
            DB::raw('fecha'),
            'total','id','facturacion',
        )
        ->where('cliente_id', '>=' , $request->nombre)
        ->where('fecha', '>=' , $request->fecha1)
        ->where('fecha', '<=' , $request->fecha2)
        ->where('estado',1)
        ->get();
        return $ventas;
    }
    public function tventasCliente(Request $request)
    {
        $ventas= Venta::select(
            DB::raw('sum(total) as total'),
        )
        ->where('cliente_id', '>=' , $request->nombre)
        ->where('fecha', '>=' , $request->fecha1)
        ->where('fecha', '<=' , $request->fecha2)
        ->where('estado',1)
        ->groupBy('cliente_id')
        ->get();
        return $ventas;
    }
    public function resumenMesActual()
    {
        $ventas= Venta::select(
            DB::raw('sum(t_compra) as costo'),
            DB::raw('sum(total) as venta'),
            DB::raw('sum(total)-sum(t_compra) as utilidad'),
            DB::raw("DATE_FORMAT(fecha,'%M %Y') as months"),
        )
        ->where('estado',1)
        ->groupBy('months')
        ->get();
        return $ventas;
    }

    public function resumenMes()
    {
        $ventas= Venta::select(
            DB::raw('sum(t_compra) as costo'),
            DB::raw('sum(total) as venta'),
            DB::raw('sum(total)-sum(t_compra) as utilidad'),
            DB::raw("DATE_FORMAT(fecha,'%W %Y') as months"),
        )
        ->where('estado',1)
        ->whereMonth('fecha', '=', now())
        ->groupBy('months')
        ->get();
        return $ventas;
    }
    public function resumenSemana()
    {
        $ventas= Venta::select(
            DB::raw('sum(t_compra) as costo'),
            DB::raw('sum(total) as venta'),
            DB::raw('sum(total)-sum(t_compra) as utilidad'),
            DB::raw("DATE_FORMAT(fecha,'%V %X') as months"),
        )
        ->where('estado',1)
        ->groupBy('months')
        ->get();
        return $ventas;
    }
    public function resumenSemanaTotal()
    {
        $ventas= Venta::select(
            DB::raw('sum(t_compra) as costo'),
            DB::raw('sum(total) as venta'),
            DB::raw('sum(total)-sum(t_compra) as utilidad'),
        )
        ->where('estado',1)
        ->whereRaw('WEEK(fecha) = ' . date('W'))
        ->groupBy('months')
        ->get();
        return $ventas;
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function facturacion()
    {
        $venta = Venta::orderBy('fecha','desc')->where('facturacion',1)->where('estado',1)->where('documento_id',1)->with(['Documento','Metodo','Cliente'])->get();
        
        $list=[];
        foreach($venta as $m){
            $list[]=$this->show($m);
        }
        return $list;
    }
    public function pagosventa()
    {
        $venta = Venta::select('ventas.id','venta.total','tesorerias.pago')
                        ->leftjoin('tesorerias', 'ventas.id', '=', 'tesorerias.venta_id')
                        ->get();

                        return $venta;        
    }
    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->total=$request->t_neto + $request->t_impuesto;
        $venta->t_compra=$request->t_compra;
        $venta->ndocumento=$request->ndocumento;
        $venta->t_neto=$request->t_neto;
        $venta->t_impuesto=$request->t_impuesto;
        $venta->cliente_id=$request->cliente_id;
        if($venta->fecha  = $request->fecha == null ){
            $venta->fecha= now()->format('Y-m-d');
         }else{
            $venta->fecha=$request->fecha;
         }
       
        $venta->usuario_id=$request->usuario_id;
        $venta->empresa_id=$request->empresa_id;
        $venta->sucursal_id=$request->sucursal_id;
        $venta->documento_id=$request->documento_id;
         $venta->pago=$request->total;
        $venta->metodo_id=$request->metodo_id;
        $venta->cambio=$request->cambio;
        $venta->tipo=$request->tipo;
        $venta->motivo=$request->motivo;
        if($venta->documento_id = 1){
            $venta->facturacion=1;
            
         }else{
            $venta->facturacion=0;
         }
        $venta->save();
        $numero = Venta::all()->count();
        if(isset($request->pagos)){
            if(!empty($request->pagos)){
                foreach($request->pagos as $m){
        $tesoreria = new Tesoreria();
        $tesoreria->venta_id=$venta->id;
        $tesoreria->t_mov = 1;
        $tesoreria->cliente_id = $venta->cliente_id;
        $tesoreria->metodo_id = $m['metodo_id'];   
        $tesoreria->cantidad = $m['cantidad'];
        $tesoreria->pago = $m['monto']*$m['cantidad'];
        $tesoreria->referencia = $m['referencia'];
        $tesoreria->fecha = $venta->fecha;
        $tesoreria->user_id = $venta->usuario_id;
        $tesoreria->estado = 1;
        $tesoreria->save();
                }
            }
        }
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $articulo = $m['articulo'];
        $inventario = new Inventario();
        $inventario->articulo_id = $articulo['id'];
        $inventario->tipo = 2;
        $inventario->fecha = $venta['fecha'];
        $inventario->compra = $m['precioc'];
        $inventario->venta = $m['precio'];
        $inventario->impuesto = $m['porcentaje'];
        $inventario->kilos = $m['kilos'];
        $inventario->total = $m['precio']+$m['precio']*$m['porcentaje'];
        $inventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $inventario->bodega_id = $articulo['bodega_id'];
        $inventario->cantidad = $m['cantidad'];
        $inventario->motivo = "venta #".$numero;
        $inventario->save();
        $ventaInventario = new VentaInventario();
        $ventaInventario->inventario_id = $inventario->id;
        $ventaInventario->venta_id = $venta->id;
        $ventaInventario->articulo_id = $articulo['id'];
        $ventaInventario->c_stock = $m['c_stock'];
        $ventaInventario->cantidad = $m['cantidad'];
        $ventaInventario->precioc = $m['precioc'];
        $ventaInventario->precio = $m['precio']+$m['precio']*$m['porcentaje'];
        $ventaInventario->impuesto = $m['porcentaje'];
        $ventaInventario->neto = $m['precio'];
        $ventaInventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $ventaInventario->save();
                }
            }
        }
        return $this->show($venta);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function ventaCategoria()
    {
  
        return Articulo::select('nombre','categoria_id')->with(['Categoria'])->where('categoria_id',2)->with(['Inventario'=>function($a){
            $a->select('venta','fecha','articulo_id');
        }])
       
       
        ->get();
    }
    public function ventaCategoria2(Request $request)
    {
  
        $inventarios = DB::table('inventarios')->leftjoin('articulos', 'inventarios.articulo_id', '=', 'articulos.id')
                        ->leftjoin('categorias', 'articulos.categoria_id', '=', 'categorias.id')
                        ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
                        ->select('inventarios.fecha as fecha','inventarios.articulo_id as id_articulo','medidas.nombre as nombre_medida','articulos.nombre as nombre_articulo','articulos.categoria_id as nombre_categoria',DB::raw('SUM(inventarios.cantidad) as cantidad'),DB::raw('SUM((inventarios.venta)*(inventarios.cantidad)) as total'),DB::raw('SUM(((inventarios.venta)*(inventarios.cantidad))/(cantidad)) as promedio'))
                        ->where('inventarios.estado',1)
                        ->where('inventarios.tipo',2)
                        ->where('articulos.categoria_id',$request->categoria)
                        ->where('inventarios.fecha', '>=' , $request->fecha1)
                        ->where('inventarios.fecha', '<=' , $request->fecha2)
                        ->groupBy('fecha')
                        ->groupBy('nombre_articulo')
                        ->groupBy('nombre_categoria')
                        ->groupBy('nombre_medida')
                        ->groupBy('id_articulo')
                        ->get();

                        return $inventarios;
    }
    public function ventaProductos2(Request $request)
    {
  
        $inventarios = DB::table('venta_inventarios')->leftjoin('articulos', 'venta_inventarios.articulo_id', '=', 'articulos.id')
                        ->leftjoin('ventas', 'venta_inventarios.venta_id', '=', 'ventas.id')
                        ->leftjoin('clientes', 'ventas.cliente_id', '=', 'clientes.id')
                        ->leftjoin('categorias', 'articulos.categoria_id', '=', 'categorias.id')
                        ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
                        ->select('venta_inventarios.articulo_id as id_articulo','medidas.nombre as nombre_medida','articulos.nombre as nombre_articulo','articulos.categoria_id as nombre_categoria','venta_inventarios.cantidad as cantidad','venta_inventarios.neto as neto',DB::raw('((venta_inventarios.neto)*(venta_inventarios.cantidad)) as total'))
                        ->where('venta_inventarios.estado',1)
                        ->where('venta_inventarios.tipo',2)
                        ->where('fecha', '>=' , $request->fecha1)
                        ->where('fecha', '<=' , $request->fecha2)
                        ->get();
                        return $inventarios;
    }
    public function ventaProductos(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
  
        $inventarios = DB::table('venta_inventarios')
                        ->leftjoin('articulos', 'venta_inventarios.articulo_id', '=', 'articulos.id')
                        ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
                        ->leftjoin('ventas', 'venta_inventarios.venta_id', '=', 'ventas.id')
                        ->leftjoin('clientes', 'ventas.cliente_id', '=', 'clientes.id')
                        ->select('venta_inventarios.articulo_id as id_articulo','articulos.nombre as nombre_articulo','medidas.nombre as nombre_medida','clientes.nombre as nombre_cliente','ventas.fecha as fecha','venta_inventarios.cantidad as cantidad','venta_inventarios.neto as neto','venta_inventarios.precioc as compra',DB::raw('((venta_inventarios.neto)*(venta_inventarios.cantidad)) as total'),DB::raw('((venta_inventarios.precioc)*(venta_inventarios.cantidad)) as tcompra'),DB::raw('((venta_inventarios.neto)*(venta_inventarios.cantidad))-((venta_inventarios.precioc)*(venta_inventarios.cantidad)) as margen'),DB::raw('((1-(((venta_inventarios.precioc)*(venta_inventarios.cantidad))/((venta_inventarios.neto)*(venta_inventarios.cantidad))))*100) as pmargen'))
                        ->where('venta_inventarios.estado',1)
                        ->where($criterio, 'like' , '%'. $buscar . '%')
                        ->where('fecha', '>=' , $request->fecha1)
                        ->where('fecha', '<=' , $request->fecha2)
                        ->get();

                        return $inventarios;
    }
    public function show(Venta $venta)
    {
        $venta->cliente = $venta->Cliente;
        $venta->metodo = $venta->Metodo;
        $venta->documento = $venta->Documento;
        $venta->venta_inventarios = $venta->VentaInventario()->with(['Inventario'=>function($i){
            $i->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria','Medida','Bodega']);
            }]);
        }])->get();

        
        $venta->url_pdf = url('api/reportes/ventas/'.$venta->id);
        $venta->url_pdf2 = url('api/reportes/ventasgas/'.$venta->id);
        return $venta;
    }
    public function Gas(Venta $venta)
    {
        $venta = Venta::orderBy('fecha','desc')->where('estado',1)->where('sucursal_id','<>',1)->with(['Documento','Metodo','Cliente'])->get();
        
        $list=[];
        foreach($venta as $m){
            $list[]=$this->show($m);
        }
        return $list;
    }

    public function pdf(Venta $venta)
    {
        $venta = $this->show($venta);
        $pdf = PDF::loadView('reports.venta', ["venta"=>$venta]);
        return $pdf->stream();
    }
    public function pdfgas(Venta $venta)
    {
        $venta = $this->show($venta);
        $pdf = PDF::loadView('reports.ventagas', ["venta"=>$venta]);
        return $pdf->stream();
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $venta->facturacion = 0;
        $venta->f_fac = $request->f_fac;
        $venta->ncontable = $request->ncontable;
        $venta->save();
    }

    public function updateCliente(Request $request, Venta $venta)
    {
        $venta->cliente_id = $request->cliente_id;
        $venta->ncontable = $request->ncontable;
        $venta->save();
        $tesoreria = $request->cliente_id;
        ;
            $tesoreria->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function facton(Request $request, Venta $venta)
    {
        $venta->facturacion = 0;
        $venta->f_fac = $request->f_fac;
        $venta->ncontable = $request->ncontable;
        $venta->save();
    }
    public function destroy(Venta $venta)
    {
        $venta->estado =0;
        $venta->save();
    }
}
