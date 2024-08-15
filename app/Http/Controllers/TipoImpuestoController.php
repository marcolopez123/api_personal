<?php

namespace App\Http\Controllers;

use App\Models\TipoImpuesto;
use App\Models\TipoPagosLegale;
use Illuminate\Http\Request;

class TipoImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoImpuesto::with(['TipoPagosLegale',])->orderBy('nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoImpuesto = new TipoImpuesto();
        $tipoImpuesto->nombre = $request->nombre;
        $tipoImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tipoImpuesto->save();
        return $tipoImpuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoImpuesto  $tipoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function show(TipoImpuesto $tipoImpuesto)
    {
        return $tipoImpuesto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoImpuesto  $tipoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoImpuesto $tipoImpuesto)
    {
        $tipoImpuesto->nombre = $request->nombre;
        $tipoImpuesto->tipo_pagos_legale_id = $request->tipo_pagos_legale_id;
        $tipoImpuesto->save();
        return $tipoImpuesto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoImpuesto  $tipoImpuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoImpuesto $tipoImpuesto)
    {
        $tipoImpuesto->estado = 0;
        $tipoImpuesto->save();
        return $tipoImpuesto;
    
    }
}
