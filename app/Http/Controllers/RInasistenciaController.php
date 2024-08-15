<?php

namespace App\Http\Controllers;

use App\Models\RInasistencia;
use Illuminate\Http\Request;

class RInasistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RInasistencia::with(['TPeriodo','RTipoInasistencia','Trabajador'])->where('estado',1)->orderBy('id')->get();
    }
    
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $filtro2 = $request->filtro2;
        return  RInasistencia::with(['TPeriodo','RTipoInasistencia','Trabajador'])->where('trabajador_id',$filtro)->where('t_periodo_id',$filtro2)->orderBy('f_desde')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rInasistencia = new RInasistencia();
        $rInasistencia->trabajador_id = $request->trabajador_id;
        $rInasistencia->f_desde = $request->f_desde;
        $rInasistencia->f_hasta = $request->f_hasta;
        $rInasistencia->cantidad = $request->cantidad;
        $rInasistencia->r_tipo_inasistencia_id = $request->r_tipo_inasistencia_id;
        $rInasistencia->remunerado = $request->remunerado;
        $rInasistencia->t_periodo_id = $request->t_periodo_id;
        $rInasistencia->comentario  = $request->comentario ;
        $rInasistencia->save();
        return $rInasistencia;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RInasistencia  $rInasistencia
     * @return \Illuminate\Http\Response
     */
    public function show(RInasistencia $rInasistencia)
    {
        $rInasistencia->trabajador = $rContrato->Trabajador;
        $rInasistencia->tperiodo = $rContrato->TPeriodo;
        $rInasistencia->rtipoinasistencia = $rInasistencia->RTipoInasistencia;
        return $rInasistencia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RInasistencia  $rInasistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RInasistencia $rInasistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RInasistencia  $rInasistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(RInasistencia $rInasistencia)
    {
        //
    }
}
