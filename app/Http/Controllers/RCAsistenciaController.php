<?php

namespace App\Http\Controllers;

use App\Models\RCAsistencia;
use Illuminate\Http\Request;

class RCAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RCAsistencia::with(['Trabajador','Empresa','Sucursal'])->where('estado',1)->orderBy('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $model= RCAsistencia::with(['Empresa','Trabajador','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->where('estado',1)->get();
        return $model; 
    }
    public function Filtro2(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $trabajador = $request->trabajador;
        $model= RCAsistencia::with(['Empresa','Trabajador','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->where('trabajador_id',$trabajador)->where('estado',1)->get();
        return $model; 
    }
    public function filtroSalida(Request $request)
    {
        $trabajador = $request->trabajador;
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $model= RCAsistencia::with(['Empresa','Trabajador','Sucursal'])->where('trabajador_id',$trabajador)->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->Where('salida',null)->where('estado',1)->get();
        return $model; 
    }
    public function store(Request $request)
    {
        $rCAsistencia = new RCAsistencia();
        $rCAsistencia->fecha = $request->fecha;
        $rCAsistencia->entrada = $request->entrada;
        $rCAsistencia->empresa_id = $request->empresa_id;
        $rCAsistencia->sucursal_id = $request->sucursal_id;
        $rCAsistencia->trabajador_id = $request->trabajador_id;
        $rCAsistencia->longitud = $request->longitud;
        $rCAsistencia->latitud = $request->latitud;
        $rCAsistencia->save();
        return $rCAsistencia;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RCAsistencia  $rCAsistencia
     * @return \Illuminate\Http\Response
     */
    public function show(RCAsistencia $rCAsistencia)
    {
        $rCAsistencia->trabajador = $rCAsistencia->Trabajador;
        $rCAsistencia->empresa = $rCAsistencia->Empresa;
        $rCAsistencia->sucursal = $rCAsistencia->Sucursal;
        return $rCAsistencia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RCAsistencia  $rCAsistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RCAsistencia $rCAsistencia)
    {
        $rCAsistencia->salida = $request->salida;
        $rCAsistencia->longituds = $request->longituds;
        $rCAsistencia->latituds = $request->latituds;
        $rCAsistencia->save();
        return $rCAsistencia;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RCAsistencia  $rCAsistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(RCAsistencia $rCAsistencia)
    {
        //
    }
}
