<?php

namespace App\Http\Controllers;

use App\Models\TGRemuneracione;
use App\Models\TPRemuneracione;
use App\Models\TTarea;
use App\Models\Empresa;
use App\Models\TPeriodo;
use Illuminate\Http\Request;

class TGRemuneracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TGRemuneracione::with(['TPRemuneracione','Empresa','TPeriodo','TTarea'])->orderBy('t_periodo_id')->where('estado',1)->get();
    }
    
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return TGRemuneracione::with(['TPRemuneracione','Empresa','TPeriodo','TTarea'])->where('empresa_id', $filtro)->orderBy('t_periodo_id')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tGRemuneracione = new TGRemuneracione();
        $tGRemuneracione->empresa_id = $request->empresa_id;
        $tGRemuneracione->t_periodo_id = $request->t_periodo_id;
        $tGRemuneracione->t_tarea_id = $request->t_tarea_id;
        $tGRemuneracione->t_p_remuneracione_id = $request->t_p_remuneracione_id;
        $tGRemuneracione->validador = $request->t_tarea_id . "-" . $request->empresa_id . "-" . $request->t_periodo_id . "-" . $request->t_p_remuneracione_id;
        $tGRemuneracione->save();
        return $tGRemuneracione;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TGRemuneracione  $tGRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function show(TGRemuneracione $tGRemuneracione)
    {
        return $tGRemuneracione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TGRemuneracione  $tGRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TGRemuneracione $tGRemuneracione)
    {
        $tGRemuneracione->t_periodo_id = $request->t_periodo_id;
        $tGRemuneracione->empresa_id = $request->empresa_id;
        $tGRemuneracione->t_periodo_id = $request->t_periodo_id;
        $tGRemuneracione->t_p_remuneracione_id = $request->t_p_remuneracione_id;
        $tGRemuneracione->save();
        return $tGRemuneracione;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TGRemuneracione  $tGRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function destroy(TGRemuneracione $tGRemuneracione)
    {
        $tGRemuneracione->estado = 0;
        $tGRemuneracione->save();
        return $tGRemuneracione;
    }
}
