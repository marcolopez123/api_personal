<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\GastoDetalle;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$compra = new Compra();
        $gasto = new Gasto();
        $gasto->total=$request->total;
        $gasto->t_neto=$request->t_neto;
        $gasto->t_impuesto=$request->t_impuesto;
        $gasto->fecha=$request->fecha;
        $gasto->documento_id=$request->documento_id;
        $gasto->ndocumento=$request->ndocumento;
        $gasto->empresa_id=$request->empresa_id;
        $gasto->metodo_id=$request->metodo_id;
        $gasto->tipo=$request->tipo;
        $gasto->proveedor_id=$request->proveedor_id;
        $gasto->sucursal_id=$request->sucursal_id;
        $gasto->usuario_id=$request->usuario_id;
        $gasto->motivo=$request->motivo;
        $gasto->save();
        $numero = Gasto::all()->count();
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $articulo = $m['articulo'];
        $gastoDetalle = new GastoDetalle();           
        $gastoDetalle->articulo_id = $articulo['id'];
        $gastoDetalle->fecha = $gasto['fecha'];
        $gastoDetalle->bodega_id = $articulo['bodega_id'];
        $gastoDetalle->unitario = $m['unitario'];
        $gastoDetalle->impuesto_id = $m['impuesto_id'];
        $gastoDetalle->cantidad = $m['catidad'];
        $gastoDetalle->t_neto = $m['unitario']+$m['cantidad']*$m['porcentaje'];
        $gastoDetalle->v_impuesto = $m['precio']*$m['porcentaje'];
        $gastoDetalle->cantidad = $m['cantidad'];
        $gastoDetalle->motivo = "GASTO #".$numero;
        $gastoDetalle->compra_id = $gasto->id;
        $gastoDetalle->venta = $m['pventa'];
        $gastoDetalle->articulo_id = $articulo['id'];
        $gastoDetalle->cantidad = $m['cantidad'];
        $gastoDetalle->precio = $m['precio']+$m['precio']*$m['porcentaje'];
        $gastoDetalle->impuesto = $m['porcentaje'];
        $gastoDetalle->neto = $m['precio'];
        $gastoDetalle->v_impuesto = $m['precio']*$m['porcentaje'];
        $gastoDetalle->save();

                }
            }
        }
        return $gasto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
