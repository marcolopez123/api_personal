<?php

namespace App\Http\Controllers;

use App\Models\EProceso;
use Illuminate\Http\Request;

class EProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EProceso::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eProceso = new EProceso();
        $eProceso->nombre = $request->nombre;
        $eProceso->save();
        return $eProceso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EProceso  $eProceso
     * @return \Illuminate\Http\Response
     */
    public function show(EProceso $eProceso)
    {
        return $eProceso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EProceso  $eProceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EProceso $eProceso)
    {
        $eProceso->nombre = $request->nombre;
        $eProceso->save();
        return $eProceso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EProceso  $eProceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(EProceso $eProceso)
    {
        $eProceso->estado = 0;
        $eProceso->save();
        return $eProceso;
    }
}
