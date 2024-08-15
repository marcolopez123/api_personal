<?php

namespace App\Http\Controllers;

use App\Models\TImpuesto;
use App\Models\TipoPagosLegale;
use App\Models\TipoImpuesto;
use Illuminate\Http\Request;

class TImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TImpuesto::with(['TipoPagosLegale','TipoImpuesto'])->orderBy('nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tImpuesto = new TImpuesto();
        $tImpuesto->nombre = $request->nombre;
        $tImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tImpuesto->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tImpuesto->save();
        return $tImpuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TImpuesto  $tImpuesto
     * @return \Illuminate\Http\Response
     */
    public function show(TImpuesto $tImpuesto)
    {
        return $tImpuesto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TImpuesto  $tImpuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TImpuesto $tImpuesto)
    {
        $tImpuesto->nombre = $request->nombre;
        $tImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tImpuesto->tipo_impuesto_id = $request->tipo_impuesto_id;
        $tImpuesto->save();
        return $tImpuesto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TImpuesto  $tImpuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TImpuesto $tImpuesto)
    {
        $tImpuesto->estado = 0;
        $tImpuesto->save();
        return $tImpuesto;
    }
}
