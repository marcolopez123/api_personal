<?php

namespace App\Http\Controllers;

use App\Models\TPRemuneracione;
use Illuminate\Http\Request;

class TPRemuneracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TPRemuneracione::orderBy('nombre')->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tPRemuneracione = new TPRemuneracione();
        $tPRemuneracione->nombre = $request->nombre;
        $tPRemuneracione->save();
        return $tPRemuneracione;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TPRemuneracione  $tPRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function show(TPRemuneracione $tPRemuneracione)
    {
        return $tPRemuneracione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPRemuneracione  $tPRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPRemuneracione $tPRemuneracione)
    {
        $tPRemuneracione->nombre = $request->nombre;
        $tPRemuneracione->save();
        return $tPRemuneracione;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPRemuneracione  $tPRemuneracione
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPRemuneracione $tPRemuneracione)
    {
        $tPRemuneracione->estado = 0;
        $tPRemuneracione->save();
        return $tPRemuneracione;
    }
}
