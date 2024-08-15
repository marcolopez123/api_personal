<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\T_estado_pago;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Facturacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Facturacione::with(['Cliente','T_estado_pago'])->where('estado',1)->orderBy('fecha','asc')->get();
    }

    public function Filtro(Request $request)
    {
        $empresa = $request->empresa;
        $sucursal = $request->sucursal;
        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        return Facturacione::with(['Cliente','T_estado_pago'])->where('estado',1)->orderBy('fecha','asc')->where('empresa_id',$empresa)->where('sucursal_id',$sucursal)->where('fecha', '>=' , $request->fecha1)->where('fecha', '<=' , $request->fecha2)->get();
    }

    public function Filtro2(Request $request)
    {

        return Facturacione::select('cliente_id',DB::raw('SUM(monto) as monto'))
        ->with(['Cliente'])
        ->where('estado',1)
        ->where('t_estado_pago_id',1)
        ->where('empresa_id', '=' , $request->empresa)
        ->where('empresa_id', '=' , $request->sucursal)
        ->groupBy('cliente_id')
        ->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facturacione = new Facturacione();
        $facturacione->cliente_id = $request->cliente_id;
        $facturacione->empresa_id = $request->empresa_id;
        $facturacione->sucursal_id = $request->sucursal_id;
        $facturacione->nro = $request->nro;
        $facturacione->orden = $request->orden;
        $facturacione->fecha = $request->fecha;
        $facturacione->plazo = $request->plazo;
        $facturacione->monto = $request->monto;
        $facturacione->t_estado_pago_id = $request->t_estado_pago_id;
        $facturacione->save();
        return $facturacione;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturacione  $facturacione
     * @return \Illuminate\Http\Response
     */
    public function show(Facturacione $facturacione)
    {
        $facturacione->cliente = $facturacione->Cliente;
        $facturacione->t_estado_pago = $facturacione->T_estado_pago;
        return $facturacione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturacione  $facturacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturacione $facturacione)
    {
        $facturacione->cliente_id = $request->cliente_id;
        $facturacione->nro = $request->nro;
        $facturacione->orden = $request->orden;
        $facturacione->fecha = $request->fecha;
        $facturacione->plazo = $request->plazo;
        $facturacione->monto = $request->monto;
        $facturacione->t_estado_pago_id = $request->t_estado_pago_id;
        $facturacione->save();
        return $facturacione;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturacione  $facturacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facturacione $facturacione)
    {
        $facturacione->estado = 0;
        $facturacione->save();
    }
}
