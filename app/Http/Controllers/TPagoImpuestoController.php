<?php

namespace App\Http\Controllers;

use App\Models\TPagoImpuesto;
use App\Models\Empresa;
use App\Models\TPeriodo;
use App\Models\EProceso;
use App\Models\TImpuesto;
use App\Models\TipoPagosLegale;
use App\Models\TipoImpuesto;
use Illuminate\Http\Request;

class TPagoImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TPagoImpuesto::with(['TipoPagosLegale','TipoImpuesto','TImpuesto','Empresa','EProceso','TPeriodo'])->orderBy('t_periodo_id')->where('estado',1)->get();
    }

    public function Filtro(Request $request)

    
    {
        $filtro = $request->filtro;
        return TPagoImpuesto::with(['TipoPagosLegale','TipoImpuesto','TImpuesto','Empresa','EProceso','TPeriodo'])->where('empresa_id', $filtro)->orderBy('t_periodo_id')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tPagoImpuesto = new TPagoImpuesto();
        $tPagoImpuesto->empresa_id = $request->empresa_id;
        $tPagoImpuesto->t_periodo_id = $request->t_periodo_id;
        $tPagoImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tPagoImpuesto->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tPagoImpuesto->t_impuesto_id = $request->t_impuesto_id;
        $tPagoImpuesto->validador = $request->empresa_id . "-" . $request->t_periodo_id . "-" . $request->tipo_pagos_legale_id . "-" . $request->tipo_impuesto_id . "-" . $request->t_impuesto_id;
        $tPagoImpuesto->monto = 0;
        $tPagoImpuesto->e_proceso_id = 1;
        $tPagoImpuesto->save();
        return $tPagoImpuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TPagoImpuesto  $tPagoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function show(TPagoImpuesto $tPagoImpuesto)
    {
        return $tPagoImpuesto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPagoImpuesto  $tPagoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPagoImpuesto $tPagoImpuesto)
    {

        $tPagoImpuesto->empresa_id = $request->empresa_id;
        $tPagoImpuesto->t_periodo_id = $request->t_periodo_id;
        $tPagoImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tPagoImpuesto->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tPagoImpuesto->t_impuesto_id = $request->t_impuesto_id;
        $tPagoImpuesto->e_proceso_id = $request->e_proceso_id;
        $tPagoImpuesto->monto = $request->monto;
        $tPagoImpuesto->save();
        return $tPagoImpuesto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPagoImpuesto  $tPagoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPagoImpuesto $tPagoImpuesto)
    {
        $tPagoImpuesto->estado = 0;
        $tPagoImpuesto->save();
        return $tPagoImpuesto;
    }
}
