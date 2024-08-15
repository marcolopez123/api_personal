<?php

namespace App\Http\Controllers;

use App\Models\TImpAutomatico;
use App\Models\Empresa;
use App\Models\TPeriodo;
use App\Models\EProceso;
use App\Models\TImpuesto;
use App\Models\TipoPagosLegale;
use App\Models\TipoImpuesto;
use Illuminate\Http\Request;

class TImpAutomaticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TImpAutomatico::with(['TipoPagosLegale','TipoImpuesto','TImpuesto','Empresa','EProceso','TPeriodo'])->orderBy('empresa_id')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tImpAutomatico = new TImpAutomatico();
        $tImpAutomatico->empresa_id = $request->empresa_id;
        $tImpAutomatico->t_periodo_id = $request->t_periodo_id;
        $tImpAutomatico->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tImpAutomatico->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tImpAutomatico->t_impuesto_id = $request->t_impuesto_id;
        $tImpAutomatico->monto = 0;
        $tImpAutomatico->e_proceso_id = 1;
        $tImpAutomatico->save();
        return $tImpAutomatico;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TImpAutomatico  $tImpAutomatico
     * @return \Illuminate\Http\Response
     */
    public function show(TImpAutomatico $tImpAutomatico)
    {
        return $tImpAutomatico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TImpAutomatico  $tImpAutomatico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TImpAutomatico $tImpAutomatico)
    {
        $tImpAutomatico->empresa_id = $request->empresa_id;
        $tImpAutomatico->t_periodo_id = $request->t_periodo_id;
        $tImpAutomatico->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tImpAutomatico->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tImpAutomatico->t_impuesto_id = $request->t_impuesto_id;
        $tImpAutomatico->monto = 0;
        $tImpAutomatico->e_proceso_id = 1;
        $tImpAutomatico->save();
        return $tImpAutomatico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TImpAutomatico  $tImpAutomatico
     * @return \Illuminate\Http\Response
     */
    public function destroy(TImpAutomatico $tImpAutomatico)
    {

        $tImpAutomatico->estado = 0;
        $tImpAutomatico->save();
        return $tImpAutomatico;
    }
}
