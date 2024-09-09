<?php

namespace App\Http\Controllers;

use App\Models\RContrato;
use App\Models\TPeriodoTrabajadore;
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
        return  RContrato::with(['RTipoContrato','Trabajador','Empresa','Sucursal','RDocContrato'])->where('trabajador_id',$filtro)->orderBy('f_inicio')->get();
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Guardar el contrato en la tabla r_contratos
    $rContrato = new RContrato();
    $rContrato->r_doc_contrato_id = $request->r_doc_contrato_id;
    $rContrato->empresa_id = $request->empresa_id;
    $rContrato->sucursal_id = $request->sucursal_id;
    $rContrato->trabajador_id = $request->trabajador_id;
    $rContrato->r_tipo_contrato_id = $request->r_tipo_contrato_id;
    $rContrato->s_base = $request->s_base;

    // Asegurarse de que las fechas solo contengan Año-Mes-Día (YYYY-MM-DD)
    $f_inicio = date('Y-m-d', strtotime($request->f_inicio));
    $f_termino = date('Y-m-d', strtotime($request->f_termino));

    $rContrato->f_inicio = $f_inicio;
    $rContrato->f_termino = $f_termino;
    $rContrato->save();

    // Realizar el update en la tabla t_periodo_trabajadores
    $tPeriodoTrabajador = TPeriodoTrabajadore::where('trabajador_id', $request->trabajador_id)
        ->where('t_periodo_id', $request->t_periodo_id) // Asegurarse de que el periodo es correcto
        ->first();

    if ($tPeriodoTrabajador) {
        // Actualizar el registro en t_periodo_trabajadores
        $tPeriodoTrabajador->r_contrato_id = $rContrato->id;
        $tPeriodoTrabajador->empresa_id =$rContrato->empresa_id;   // Actualizar la fecha de inicio con el formato YYYY-MM-DD
        $tPeriodoTrabajador->sucursal_id = $rContrato->sucursal_id;
        $tPeriodoTrabajador->r_tipo_contrato_id = $rContrato->r_tipo_contrato_id;   // Actualizar la fecha de término con el formato YYYY-MM-DD
        $tPeriodoTrabajador->sbase = $request->s_base;

        // Verificar si r_tipo_contrato_id es 1 y d_mes es 0
        if ($request->r_tipo_contrato_id == 1 && $tPeriodoTrabajador->d_mes == 0) {
            // Calcular el último día del mes de f_inicio
            $ultimoDiaMes = new \DateTime($f_inicio);
            $ultimoDiaMes->modify('last day of this month');
            
            // Calcular la diferencia de días entre f_inicio y el último día del mes
            $diferenciaDias = $ultimoDiaMes->diff(new \DateTime($f_inicio))->days + 1;
            
            // Asignar el valor de la diferencia de días a d_mes
            $tPeriodoTrabajador->d_mes = $diferenciaDias;
        }

        // Guardar los cambios en t_periodo_trabajadores
        $tPeriodoTrabajador->save();
    }

    return $rContrato;
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
