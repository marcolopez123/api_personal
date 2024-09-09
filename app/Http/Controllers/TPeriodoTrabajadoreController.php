<?php

namespace App\Http\Controllers;

use App\Models\TPeriodoTrabajadore;
use App\Models\RContrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TPeriodoTrabajadoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tPeriodoTrabajador= TPeriodoTrabajadore::with(['TPeriodo','Trabajador','TSalude','TPrevisione','Empresa','Sucursal','RContrato'])->leftjoin('r_contratos', 't_periodo_trabajadores.r_contrato_id', '=', 'r_contratos.id')
                                                  ->leftjoin('r_doc_contratos', 'r_contratos.r_doc_contrato_id', '=', 'r_doc_contratos.id')
                                                  ->leftjoin('r_tipo_contratos', 'r_contratos.r_tipo_contrato_id', '=', 'r_tipo_contratos.id')
                                                  
       
        ->where('t_periodo_trabajadores.estado',1)
        ->get();
        return $tPeriodoTrabajador;
   
    }
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $filtro2 = $request->filtro2;
        $tPeriodoTrabajador= TPeriodoTrabajadore::with(['TPeriodo','Trabajador','TSalude','TPrevisione','Empresa','Sucursal','RContrato'])
        
        ->where('t_periodo_trabajadores.estado',1)
        ->where('t_periodo_trabajadores.trabajador_id',$filtro)
        ->where('t_periodo_trabajadores.t_periodo_id',$filtro2)
        ->get();
        return $tPeriodoTrabajador;
       
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tPeriodoTrabajadore = new TPeriodoTrabajadore();
        $tPeriodoTrabajadore->trabajador_id = $request->trabajador_id;
        $tPeriodoTrabajadore->t_periodo_id = $request->t_periodo_id;
        $tPeriodoTrabajadore->t_previsione_id = $request->t_previsione_id;
        $tPeriodoTrabajadore->t_salude_id = $request->t_salude_id;
        $tPeriodoTrabajadore->f_grat = 0.07;
        $tPeriodoTrabajadore->save();
        return $tPeriodoTrabajadore;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TPeriodoTrabajadore  $tPeriodoTrabajadore
     * @return \Illuminate\Http\Response
     */
    public function show(TPeriodoTrabajadore $tPeriodoTrabajadore, RContrato $rContrato)
    {
        $tPeriodoTrabajadore->t_periodo = $tPeriodoTrabajadore->TPeriodo;
        $tPeriodoTrabajadore->rcontrato = $tPeriodoTrabajadore->RContrato;
        $tPeriodoTrabajadore->rdocumento = $tPeriodoTrabajadore->RDocContrato;
        $tPeriodoTrabajadore->trabajador = $tPeriodoTrabajadore->Trabajador;
        $tPeriodoTrabajadore->t_previsione = $tPeriodoTrabajadore->TPrevisione;
        $tPeriodoTrabajadore->t_salude = $tPeriodoTrabajadore->TSalude;
        $tPeriodoTrabajadore->empresa = $tPeriodoTrabajadore->Empresa;
        $tPeriodoTrabajadore->sucursal = $tPeriodoTrabajadore->Sucursal;
        return $tPeriodoTrabajadore;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPeriodoTrabajadore  $tPeriodoTrabajadore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPeriodoTrabajadore $tPeriodoTrabajadore)
    {
        $tPeriodoTrabajadore->t_p_previsione_id = $request->t_p_previsione_id;
        $tPeriodoTrabajadore->save();
        return $tPeriodoTrabajadore;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPeriodoTrabajadore  $tPeriodoTrabajadore
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPeriodoTrabajadore $tPeriodoTrabajadore)
    {
        //
    }
    public function Contrato(TPeriodoTrabajadore $TPeriodoTrabajadore)
    {
        

        $tPeriodoTrabajador= TPeriodoTrabajadore::with(['TPeriodo','Trabajador','TSalude','TPrevisione','Empresa','Sucursal','RContrato'])->leftjoin('r_contratos', 't_periodo_trabajadores.r_contrato_id', '=', 'r_contratos.id')
        ->leftjoin('r_doc_contratos', 'r_contratos.r_doc_contrato_id', '=', 'r_doc_contratos.id')
        

        ->where('t_periodo_trabajadores.estado',1)
        ->get();
        return $tPeriodoTrabajador;
    }
}
