<?php

namespace App\Http\Controllers;

use App\Models\TGHonorario;
use App\Models\TTipoHonorario;
use App\Models\Epresa;
use App\Models\TPeriodo;
use Illuminate\Http\Request;

class TGHonorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TGHonorario::with(['TTipoHonorario','Empresa','TPeriodo'])->orderBy('t_periodo_id')->where('estado',1)->get();
    }

    public function Filtro(Request $request)

    
    {
        $filtro = $request->filtro;
        return TGHonorario::with(['TTipoHonorario','Empresa','TPeriodo'])->where('empresa_id', $filtro)->orderBy('t_periodo_id')->where('estado',1)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tGHonorario = new TGHonorario();
        $tGHonorario->monto = $request->monto;
        $tGHonorario->t_periodo_id = $request->t_periodo_id;
        $tGHonorario->empresa_id = $request->empresa_id;
        $tGHonorario->t_tipo_honorario_id = $request->t_tipo_honorario_id;
        $tGHonorario->save();
        return $tGHonorario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TGHonorario  $tGHonorario
     * @return \Illuminate\Http\Response
     */
    public function show(TGHonorario $tGHonorario)
    {
        return $tGHonorario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TGHonorario  $tGHonorario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TGHonorario $tGHonorario)
    {
        $tGHonorario->monto = $request->monto;
        $tGHonorario->t_periodo_id = $request->t_periodo_id;
        $tGHonorario->empresa_id = $request->empresa_id;
        $tGHonorario->t_tipo_honorario_id = $request->t_tipo_honorario_id;
        $tGHonorario->save();
        return $tGHonorario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TGHonorario  $tGHonorario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TGHonorario $tGHonorario)
    {
        $tGHonorario->estado = 0;
        $tGHonorario->save();
        return $tGHonorario;
    }
}
