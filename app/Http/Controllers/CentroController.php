<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Centro::with(['Empresa','Sucursal'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centro = new Centro();      
        $centro->empresa_id = $request->empresa_id;
        $centro->sucursal_id = $request->sucursal_id;
        $centro->fcentro_id = $request->fcentro_id;
        $centro->nombre = $request->nombre;
        $centro->codigo = $request->codigo;
        $centro->save();
        return $centro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        $centro->empresa = $centro->Empresa;
        $centro->sucursal = $centro->Sucursal;
        return $centro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Centro $centro)
    {
        $centro->empresa_id = $request->empresa_id;
        $centro->sucursal_id = $request->sucursal_id;
        $centro->fcentro_id = $request->fcentro_id;
        $centro->nombre = $request->nombre;
        $centro->codigo = $request->codigo;
        $centro->save();
        return $centro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        $centro->estado = 0;
        $centro->save();
    }
}
