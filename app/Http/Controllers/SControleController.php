<?php

namespace App\Http\Controllers;

use App\Models\SControle;
use Illuminate\Http\Request;

class SControleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SControle::with(['SCentro','Trabajador'])->where('estado',1)->get();
    }
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $model= SControle::with(['Trabajador','SCentro'])->where('trabajador_id',$filtro)->where('estado',1)->get();
        return $model; 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sControle = new SControle();
        $sControle->trabajador_id = $request->trabajador_id;
        $sControle->s_centro_id = $request->s_centro_id;
        $sControle->fecha_hora = $request->fecha_hora;
        $sControle->longitud = $request->longitud;
        $sControle->latitud = $request->latitud;
        $sControle->save();
        return $sControle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SControle  $sControle
     * @return \Illuminate\Http\Response
     */
    public function show(SControle $sControle)
    {
        return $sControle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SControle  $sControle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SControle $sControle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SControle  $sControle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SControle $sControle)
    {
        //
    }
}
