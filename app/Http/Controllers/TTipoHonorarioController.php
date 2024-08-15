<?php

namespace App\Http\Controllers;

use App\Models\TTipoHonorario;
use Illuminate\Http\Request;

class TTipoHonorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TTipoHonorario::orderBy('nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tTipoHonorario = new TTipoHonorario();
        $tTipoHonorario->nombre = $request->nombre;
        $tTipoHonorario->save();
        return $tTipoHonorario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TTipoHonorario  $tTipoHonorario
     * @return \Illuminate\Http\Response
     */
    public function show(TTipoHonorario $tTipoHonorario)
    {
        return $tTipoHonorario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TTipoHonorario  $tTipoHonorario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TTipoHonorario $tTipoHonorario)
    {
        $tTipoHonorario->nombre = $request->nombre;
        $tTipoHonorario->save();
        return $tTipoHonorario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TTipoHonorario  $tTipoHonorario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TTipoHonorario $tTipoHonorario)
    {
        $tTipoHonorario->estdo = 0;
        $tTipoHonorario->save();
        return $tTipoHonorario;
    }
}
