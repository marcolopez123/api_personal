<?php

namespace App\Http\Controllers;

use App\Models\T_estado_pago;
use Illuminate\Http\Request;

class TEstadoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return T_estado_pago::get();
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
     * @param  \App\Models\T_estado_pago  $t_estado_pago
     * @return \Illuminate\Http\Response
     */
    public function show(T_estado_pago $t_estado_pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\T_estado_pago  $t_estado_pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, T_estado_pago $t_estado_pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\T_estado_pago  $t_estado_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(T_estado_pago $t_estado_pago)
    {
        //
    }
}
