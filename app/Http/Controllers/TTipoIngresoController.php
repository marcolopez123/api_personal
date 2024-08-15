<?php

namespace App\Http\Controllers;

use App\Models\TTipoIngreso;
use Illuminate\Http\Request;

class TTipoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TTipoIngreso::orderBy('nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tTipoIngreso = new TTipoIngreso();
        $tTipoIngreso->nombre = $request->nombre;
        $tTipoIngreso->save();
        return $tTipoIngreso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TTipoIngreso  $tTipoIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(TTipoIngreso $tTipoIngreso)
    {

        return $tTipoIngreso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TTipoIngreso  $tTipoIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TTipoIngreso $tTipoIngreso)
    {
        $tTipoIngreso->nombre = $request->nombre;
        $tTipoIngreso->save();
        return $tTipoIngreso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TTipoIngreso  $tTipoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(TTipoIngreso $tTipoIngreso)
    {
        $tTipoIngreso->estado = 0;
        $tTipoIngreso->save();
        return $tTipoIngreso;
    }
}
