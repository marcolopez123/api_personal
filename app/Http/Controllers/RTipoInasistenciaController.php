<?php

namespace App\Http\Controllers;

use App\Models\RTipoInasistencia;
use Illuminate\Http\Request;

class RTipoInasistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RTipoInasistencia::where('estado',1)->get();
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
     * @param  \App\Models\RTipoInasistencia  $rTipoInasistencia
     * @return \Illuminate\Http\Response
     */
    public function show(RTipoInasistencia $rTipoInasistencia)
    {
        return $rTipoInasistencia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RTipoInasistencia  $rTipoInasistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RTipoInasistencia $rTipoInasistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RTipoInasistencia  $rTipoInasistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(RTipoInasistencia $rTipoInasistencia)
    {
        //
    }
}
