<?php

namespace App\Http\Controllers;

use App\Models\RTipoContrato;
use Illuminate\Http\Request;

class RTipoContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RTipoContrato::where('estado',1)->get();
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
     * @param  \App\Models\RTipoContrato  $rTipoContrato
     * @return \Illuminate\Http\Response
     */
    public function show(RTipoContrato $rTipoContrato)
    {
        return $rTipoContrato;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RTipoContrato  $rTipoContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RTipoContrato $rTipoContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RTipoContrato  $rTipoContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(RTipoContrato $rTipoContrato)
    {
        //
    }
}
