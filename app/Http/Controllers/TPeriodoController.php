<?php

namespace App\Http\Controllers;

use App\Models\TPeriodo;
use App\Models\TPagoImpuesto;
use App\Models\TGRemuneracione;
use Illuminate\Http\Request;

class TPeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TPeriodo::with(['Ano','Mese'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tPeriodo = new TPeriodo();
        $tPeriodo->nombre = $request->nombre;
        $tPeriodo->mese_id = $request->mese_id;
        $tPeriodo->f_desde = $request->f_desde;
        $tPeriodo->f_hasta = $request->f_hasta;
        $tPeriodo->d_mes = $request->d_mes;
        $tPeriodo->ano_id = $request->ano_id;
        $tPeriodo->mes_ano = $request->mese_id . "-" . $request->ano_id;
        $tPeriodo->save();
        if(isset($request->impuestos)){
            if(!empty($request->impuestos)){
                foreach($request->impuestos as $m){
        $tPagoImpuesto = new TPagoImpuesto();            
        $tPagoImpuesto->empresa_id = $m['empresa_id'];
        $tPagoImpuesto->t_periodo_id = $tPeriodo->id;
        $tPagoImpuesto->tipo_pagos_legale_id = $m['tipo_pagos_legale_id'];
        $tPagoImpuesto->tipo_impuesto_id = $m['tipo_impuesto_id'];
        $tPagoImpuesto->t_impuesto_id = $m['t_impuesto_id'];
        $tPagoImpuesto->validador = $m['empresa_id'] . "-" . $tPeriodo->id . "-" . $m['tipo_pagos_legale_id'] . "-" . $m['tipo_impuesto_id'] . "-" . $m['t_impuesto_id'];
        $tPagoImpuesto->monto = 0;
        $tPagoImpuesto->e_proceso_id = 1;
        $tPagoImpuesto->save();
             }
            }
        }
        if(isset($request->remu)){
            if(!empty($request->remu)){
                foreach($request->remu as $r){
        $tGRemuneracione = new TGRemuneracione();
        $tGRemuneracione->t_periodo_id = $tPeriodo->id;
        $tGRemuneracione->empresa_id = $r['empresa_id'];
        $tGRemuneracione->t_p_remuneracione_id = $r['t_p_remuneracione_id'];    
        $tGRemuneracione->validador = $r['empresa_id'] . "-" . $tPeriodo->id . "-" . $r['t_p_remuneracione_id'];
        $tGRemuneracione->save();
             }
            }
        }
        return $tPeriodo; 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TPeriodo  $tPeriodo
     * @return \Illuminate\Http\Response
     */
    public function show(TPeriodo $tPeriodo)
    {
        $tPeriodo->mese = $tPeriodo->Mese;
        $tPeriodo->ano = $tPeriodo->Ano;
        return $tPeriodo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPeriodo  $tPeriodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPeriodo $tPeriodo)
    {
    
        $tPeriodo->nombre = $request->nombre;
        $tPeriodo->mese_id = $request->mese_id;
        $tPeriodo->ano_id = $request->ano_id;
        $tPeriodo->mes_ano = $request->mes_ano;
        $tPeriodo->save();
        return $tPeriodo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPeriodo  $tPeriodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPeriodo $tPeriodo)
    {
        $tPeriodo->estado = 0;
        $tPeriodo->save();
        return $tPeriodo;
    }
}
