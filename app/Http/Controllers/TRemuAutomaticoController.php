<?php

namespace App\Http\Controllers;

use App\Models\TRemuAutomatico;
use App\Models\TPRemuneracione;
use App\Models\Empresa;
use App\Models\TPeriodo;
use Illuminate\Http\Request;

class TRemuAutomaticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TRemuAutomatico::with(['TPRemuneracione','Empresa','TPeriodo'])->orderBy('empresa_id')->where('estado',1)->get();
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
     * @param  \App\Models\TRemuAutomatico  $tRemuAutomatico
     * @return \Illuminate\Http\Response
     */
    public function show(TRemuAutomatico $tRemuAutomatico)
    {
        return $tRemuAutomatico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TRemuAutomatico  $tRemuAutomatico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TRemuAutomatico $tRemuAutomatico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TRemuAutomatico  $tRemuAutomatico
     * @return \Illuminate\Http\Response
     */
    public function destroy(TRemuAutomatico $tRemuAutomatico)
    {
        //
    }
}
