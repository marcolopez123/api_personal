<?php

namespace App\Http\Controllers;

use App\Models\TRepresentante;
use App\Models\Empresa;
use Illuminate\Http\Request;

class TRepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TRepresentante::with(['Empresa'])->orderBy('p_nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tRepresentante = new TRepresentante();
        $tRepresentante->empresa_id = $request->empresa_id;
        $tRepresentante->p_nombre = $request->p_nombre;
        $tRepresentante->s_nombre = $request->s_nombre;
        $tRepresentante->a_paterno = $request->a_paterno;
        $tRepresentante->a_materno = $request->a_materno;
        $tRepresentante->telefono = $request->telefono;
        $tRepresentante->email = $request->email;
        $tRepresentante->c_sii = $request->c_sii;
        $tRepresentante->c_unica = $request->c_unica;
        $tRepresentante->save();
        return $tRepresentante;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TRepresentante  $tRepresentante
     * @return \Illuminate\Http\Response
     */
    public function show(TRepresentante $tRepresentante)
    {
        return $tRepresentante;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TRepresentante  $tRepresentante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TRepresentante $tRepresentante)
    {
        $tRepresentante->empresa_id = $request->empresa_id;
        $tRepresentante->p_nombre = $request->p_nombre;
        $tRepresentante->s_nombre = $request->s_nombre;
        $tRepresentante->a_paterno = $request->a_paterno;
        $tRepresentante->a_materno = $request->a_materno;
        $tRepresentante->telefono = $request->telefono;
        $tRepresentante->email = $request->email;
        $tRepresentante->c_sii = $request->c_sii;
        $tRepresentante->c_unica = $request->c_unica;
        $tRepresentante->save();
        return $tRepresentante;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TRepresentante  $tRepresentante
     * @return \Illuminate\Http\Response
     */
    public function destroy(TRepresentante $tRepresentante)
    {
        $tRepresentante->estado = 0;
        $tRepresentante->save();
        return $tRepresentante;
    }
}
