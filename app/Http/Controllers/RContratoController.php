<?php

namespace App\Http\Controllers;

use App\Models\RContrato;
use Illuminate\Http\Request;

class RContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RContrato::with(['RTipoContrato','Trabajador','Empresa','Sucursal'])->where('estado',1)->orderBy('id')->get();
    }

    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return  RContrato::with(['RTipoContrato','Trabajador','Empresa','Sucursal','RDocContrato'])->where('trabajador_id',$filtro)->orderBy('fecha')->get();
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RContrato  $rContrato
     * @return \Illuminate\Http\Response
     */
    public function show(RContrato $rContrato)
    {
        $rContrato->trabajador = $rContrato->Trabajador;
        $rContrato->rdoccontrato = $rContrato->RDocContrato;
        $rContrato->rtipocontrato = $rContrato->RTipoContrato;
        $rContrato->empresa = $rContrato->Empresa;
        $rContrato->sucursal = $rContrato->Sucursal;
        return $rContrato;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RContrato  $rContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RContrato $rContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RContrato  $rContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(RContrato $rContrato)
    {
        //
    }
}
