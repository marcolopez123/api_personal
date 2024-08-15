<?php

namespace App\Http\Controllers;

use App\Models\RDetalleLibro;
use Illuminate\Http\Request;

class RDetalleLibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RDetalleLibro::with(['RLibro','TPeriodo','Trabajador','TPeriodoTrabajadore'])->orderBy('id')->get();
    }
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return  RDetalleLibro::with(['RLibro','TPeriodo','Trabajador','TPeriodoTrabajadore'])->where('r_libro_id',$filtro)->orderBy('id')->get();
    }
    public function liquidacion(Request $request)
    {
        $filtro = $request->filtro;
        return  RDetalleLibro::with(['RLibro','TPeriodo','Trabajador','TPeriodoTrabajadore'])->where('trabajador_id',$filtro)->orderBy('id')->get();
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
     * @param  \App\Models\RDetalleLibro  $rDetalleLibro
     * @return \Illuminate\Http\Response
     */
    public function show(RDetalleLibro $rDetalleLibro)
    {
        $rInasistencia->trabajador = $rContrato->Trabajador;
        $rInasistencia->dperiodotrabajadore = $rContrato->DPeriodoTrabajadore;
        $rInasistencia->tperiodo = $rContrato->TPeriodo;
        $rInasistencia->rlibro = $rInasistencia->RLIbro;
        return $rInasistencia;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RDetalleLibro  $rDetalleLibro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RDetalleLibro $rDetalleLibro)
    {
        $rDetalleLibro->s_base = $request->s_base;
        $rDetalleLibro->gratificacion = $request->s_base * $request->f_grat;
        $rDetalleLibro->s_imponible = $request->s_base + $request->s_base * $request->f_grat;
        $rDetalleLibro->p_p_trab = $rDetalleLibro->s_imponible * $request->p_p_trab;
        $rDetalleLibro->p_p_adm = $rDetalleLibro->s_imponible * $request->p_p_adm;
        $rDetalleLibro->sis = $rDetalleLibro->s_imponible * $request->sis;
        $rDetalleLibro->prev = $rDetalleLibro->p_p_trab + $rDetalleLibro->p_p_adm;
        $rDetalleLibro->s_liquido = $rDetalleLibro->s_imponible - $rDetalleLibro->prev;
        $rDetalleLibro->save();
    }

    public function procesar(RDetalleLibro $rDetalleLibro, Request $request)
    {
        $model= RDetalleLibro::get();
       
    

        RDetalleLibro::where('r_libro_id', 1)->update([
            'gratificacion' => $model->s_base,
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RDetalleLibro  $rDetalleLibro
     * @return \Illuminate\Http\Response
     */
    public function destroy(RDetalleLibro $rDetalleLibro)
    {
        //
    }
}
