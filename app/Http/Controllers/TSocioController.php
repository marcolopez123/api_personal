<?php

namespace App\Http\Controllers;

use App\Models\TSocio;
use App\Models\Empresa;
use Illuminate\Http\Request;

class TSocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TSocio::with(['Empresa'])->orderBy('p_nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tSocio = new TSocio();
        $tSocio->empresa_id = $request->empresa_id;
        $tSocio->p_nombre = $request->p_nombre;
        $tSocio->s_nombre = $request->s_nombre;
        $tSocio->a_paterno = $request->a_paterno;
        $tSocio->a_materno = $request->a_materno;
        $tSocio->telefono = $request->telefono;
        $tSocio->email = $request->email;
        $tSocio->participacion = $request->participacion;
        $tSocio->save();
        return $tSocio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TSocio  $tSocio
     * @return \Illuminate\Http\Response
     */
    public function show(TSocio $tSocio)
    {
        return $tSocio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TSocio  $tSocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TSocio $tSocio)
    {
        $tSocio->empresa_id = $request->empresa_id;
        $tSocio->p_nombre = $request->p_nombre;
        $tSocio->s_nombre = $request->s_nombre;
        $tSocio->a_paterno = $request->a_paterno;
        $tSocio->a_materno = $request->a_materno;
        $tSocio->telefono = $request->telefono;
        $tSocio->email = $request->email;
        $tSocio->participacion = $request->participacion;
        $tSocio->save();
        return $tSocio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TSocio  $tSocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TSocio $tSocio)
    {
        $tSocio->estado = 0;
        $tSocio->save();
        return $tSocio;
    }
}
