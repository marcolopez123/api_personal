<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Impuesto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Impuesto = new Impuesto();
        $Impuesto->nombre = $request->nombre;
        $Impuesto->save();
        return $Impuesto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Impuesto  $impusto
     * @return \Illuminate\Http\Response
     */
    public function show(Impuesto $impuesto)
    {
        return $impuesto;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Impuesto  $impusto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        $impuesto->nombre = $request->nombre;
        $impuesto->save();
        return $impuesto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Impuesto  $impusto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->estado = 0;
        $impuesto->save();
    }
}
