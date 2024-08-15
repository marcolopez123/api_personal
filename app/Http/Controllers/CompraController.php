<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraInventario;
use App\Models\Inventario;
use App\Models\Articulo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class CompraController extends Controller
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
        $compra = Compra::whereDate('fecha', '=' , now())->orderBy("fecha","desc")->where('estado',1)->with(['Documento','Metodo','Proveedor'])->get();
        $list=[];
        foreach($compra as $m){
            $list[]=$this->show($m);
        }
    }
    else{
        $compra = Compra::where('fecha', '>=' , $request->fecha1)->where('fecha', '<=' , $request->fecha2)->orderBy("fecha","desc")->where('estado',1)->with(['Documento','Metodo','Proveedor'])->get();
        $list=[];
        foreach($compra as $m){
            $list[]=$this->show($m);
        }
    }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $compra = new Compra();
        $compra->total=$request->total;
        $compra->t_neto=$request->t_neto;
        $compra->t_impuesto=$request->t_impuesto;
        $compra->fecha=$request->fecha;
        $compra->documento_id=$request->documento_id;
        $compra->ndocumento=$request->ndocumento;
        $compra->empresa_id=$request->empresa_id;
        $compra->metodo_id=$request->metodo_id;
        $compra->tipo=$request->tipo;
        $compra->proveedor_id=$request->proveedor_id;
        $compra->sucursal_id=$request->sucursal_id;
        $compra->usuario_id=$request->usuario_id;
        $compra->motivo=$request->motivo;
        $compra->save();
        $numero = Compra::all()->count();
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $articulo = $m['articulo'];
        $inventario = new Inventario();
        $inventario->articulo_id = $articulo['id'];
        $inventario->tipo = 1;
        $inventario->fecha = $compra['fecha'];
        $inventario->bodega_id = $articulo['bodega_id'];
        $inventario->compra = $m['precio'];
        $inventario->venta = 0;
        $inventario->impuesto = $m['porcentaje'];
        $inventario->total = $m['precio']+$m['precio']*$m['porcentaje'];
        $inventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $inventario->cantidad = $m['cantidad'];
        $inventario->motivo = "COMPRA #".$numero;
        $inventario->save();
        $compraInventario = new CompraInventario();
        $compraInventario->inventario_id = $inventario->id;
        $compraInventario->compra_id = $compra->id;
        $compraInventario->venta = $m['pventa'];
        $compraInventario->c_stock = $m['c_stock'];
        $compraInventario->articulo_id = $articulo['id'];
        $compraInventario->cantidad = $m['cantidad'];
        $compraInventario->precio = $m['precio']+$m['precio']*$m['porcentaje'];
        $compraInventario->impuesto = $m['porcentaje'];
        $compraInventario->neto = $m['precio'];
        $compraInventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $compraInventario->save();

                }
            }
        }
        return $compra;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compra->compra_inventarios = $compra->CompraInventario()->with(['Inventario'=>function($i){
            $i->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria','Medida']);
            }]);
        }])->get();
        return $compra;
    }

    public function compraProductos(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
  
        $inventarios = DB::table('compra_inventarios')
                        ->leftjoin('articulos', 'compra_inventarios.articulo_id', '=', 'articulos.id')
                        ->leftjoin('medidas', 'articulos.medida_id', '=', 'medidas.id')
                        ->leftjoin('compras', 'compra_inventarios.compra_id', '=', 'compras.id')
                        ->leftjoin('proveedors', 'compras.proveedor_id', '=', 'proveedors.id')
                        ->select('compra_inventarios.articulo_id as id_articulo','articulos.nombre as nombre_articulo','medidas.nombre as nombre_medida','proveedors.nombre as nombre_proveedor','compras.fecha as fecha','compra_inventarios.cantidad as cantidad','compra_inventarios.neto as neto',DB::raw('((compra_inventarios.neto)*(compra_inventarios.cantidad)) as total'))
                        ->where('compra_inventarios.estado',1)
                        ->where($criterio, 'like' , '%'. $buscar . '%')
                        ->where('fecha', '>=' , $request->fecha1)
                        ->where('fecha', '<=' , $request->fecha2)
                        ->get();

                        return $inventarios;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        $compra->estado =0;
        $compra->save();
    }
}
