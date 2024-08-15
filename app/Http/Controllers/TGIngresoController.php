<?php

namespace App\Http\Controllers;

use App\Models\TGIngreso;
use App\Models\TTipoIngreso;
use App\Models\Epresa;
use App\Models\TPeriodo;
use Illuminate\Http\Request;

class TGIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TGIngreso::with(['TTipoIngreso','Empresa','TPeriodo'])->orderBy('t_periodo_id')->where('estado',1)->get();

    }

    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return TGIngreso::with(['TTipoIngreso','Empresa','TPeriodo'])->where('empresa_id', $filtro)->orderBy('t_periodo_id')->where('estado',1)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tGIngreso = new TGIngreso();
        $tGIngreso->monto = $request->monto;
        $tGIngreso->t_periodo_id = $request->t_periodo_id;
        $tGIngreso->empresa_id = $request->empresa_id;
        $tGIngreso->t_tipo_ingreso_id = $request->t_tipo_ingreso_id;
        $tGIngreso->save();
        return $tGIngreso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TGIngreso  $tGIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(TGIngreso $tGIngreso)
    {
        return $tGIngreso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TGIngreso  $tGIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TGIngreso $tGIngreso)
    {
        $tGIngreso->monto = $request->monto;
        $tGIngreso->t_periodo_id = $request->t_periodo_id;
        $tGIngreso->empresa_id = $request->empresa_id;
        $tGIngreso->t_tipo_ingreso_id = $request->t_tipo_ingreso_id;
        $tGIngreso->save();
        return $tGIngreso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TGIngreso  $tGIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(TGIngreso $tGIngreso)
    {
        $tGIngreso->estado = 0;
        $tGIngreso->save();
        return $tGIngreso;
    }
}
