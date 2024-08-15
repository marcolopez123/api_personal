<?php

namespace App\Http\Controllers;

use App\Models\RLibro;
use App\Models\RDetalleLibro;
use Illuminate\Http\Request;

class RLibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RLibro::with(['TPeriodo','Empresa','Sucursal'])->where('estado',1)->orderBy('id')->get();
    }

    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $filtro2 = $request->filtro2;
        return  RLibro::with(['TPeriodo','Empresa','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$filtro2)->orderBy('id')->get();
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
     * @param  \App\Models\RLibro  $rLibro
     * @return \Illuminate\Http\Response
     */
    public function show(RLibro $rLibro)
    {
        $rLibro->t_periodo = $rContrato->TPriodo;
        $rLibro->empresa = $rContrato->Empresa;
        $rLibro->sucursal = $rLibro->Sucursal;
        return $rLibro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RLibro  $rLibro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RLibro $rLibro, RDetalleLibro $rDetalleLibro)
    {
        $rLibro->proceso = $request->proceso + '1';
        $rLibro->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RLibro  $rLibro
     * @return \Illuminate\Http\Response
     */
    public function destroy(RLibro $rLibro)
    {
        //
    }
}
