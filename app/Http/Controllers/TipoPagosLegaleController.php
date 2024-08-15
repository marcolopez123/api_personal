<?php

namespace App\Http\Controllers;

use App\Models\TipoPagosLegale;
use Illuminate\Http\Request;

class TipoPagosLegaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoPagosLegale::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoPagosLegale = new TipoPagosLegale();
        $tipoPagosLegale->nombre = $request->nombre;
        $tipoPagosLegale->save();
        return $tipoPagosLegale;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoPagosLegales  $tipoPagosLegales
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPagosLegale $tipoPagosLegale)
    {
        return $tipoPagosLegale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoPagosLegale  $tipoPagosLegale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPagosLegale $tipoPagosLegale)
    {
        $tipoPagosLegale->nombre = $request->nombre;
        $tipoPagosLegale->save();
        return $tipoPagosLegale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPagosLegale  $tipoPagosLegale
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPagosLegale $tipoPagosLegale)
    {
        $tipoPagosLegale->estado = 0;
        $tipoPagosLegale->save();
        return $tipoPagosLegale;
    }
}
