<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
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
        $ingreso = new Ingreso();
        $ingreso->fecha=$request->fecha;
        $ingreso->documento_id=$request->documento_id;
        $ingreso->nro=$request->nro;
        $ingreso->neto=$request->neto;
        $ingreso->impuesto=$request->impuesto;
        $ingreso->total=$request->total;
        $ingreso->usuario_id=$request->usuario_id;
        $venta->save();
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $detalle = new detalle_ingresos();
        $detalle->ingreso_id = $ingreso['id'];
        $detalle->usuario_id = $ingreso['usuario_id'];
        $detalle->fecha = $ingreso['fecha'];
        $detalle->empresa_id = $m['empresa_id'];
        $detalle->sucursal_id = $m['sucursal_id'];
        $detalle->centro_id = $m['centro_id'];
        $detalle->detalle = $m['texto'];
        $detalle->cantidad = $m['cantidad'];
        $detalle->neto = $m['neto'];
        $detalle->total_n = $m['neto']*$m['precio'];
        $detalle->impuesto_p = $m['impuesto_p'];
        $detalle->impuesto = $m['neto']*$m['impuesto_p'];
        $detalle->total_i = $m['impuesto']*$m['cantidad'];
        $detalle->total = $m['total_n']*$m['total_i'];
        $detalle->save();
                }
            }
        }
        return $this->show($ingreso);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingreso $ingreso)
    {
        //
    }
}
