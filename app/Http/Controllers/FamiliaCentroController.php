<?php

namespace App\Http\Controllers;

use App\Models\FamiliaCentro;
use App\Models\Empresa;
use Illuminate\Http\Request;

class FamiliaCentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FamiliaCentro::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $familiacentro = new FamiliaCentro();      
        $familiacentro->empresa_id = $request->empresa_id;
        $familiacentro->usuario_id = $request->usuario_id;
        $familiacentro->nombre = $request->nombre;
        $familiacentro->save();
        return $familiacentro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamiliaCentro  $familiaCentro
     * @return \Illuminate\Http\Response
     */
    public function show(FamiliaCentro $familiacentro)
    {

        return $familiacentro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamiliaCentro  $familiaCentro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamiliaCentro $familiacentro)
    {
        $familiacentro->nombre = $request->nombre;
        $familiacentro->save();
        return $familiacentro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamiliaCentro  $familiaCentro
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamiliaCentro $familiacentro)
    {
        //
    }
}
