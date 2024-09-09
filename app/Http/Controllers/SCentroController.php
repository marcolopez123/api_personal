<?php

namespace App\Http\Controllers;

use App\Models\SCentro;
use Illuminate\Http\Request;

class SCentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SCentro::with(['Empresa','Sucursal'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sCentro = new SCentro();
        $sCentro->empresa_id = $request->empresa_id;
        $sCentro->sucursal_id = $request->sucursal_id;
        $sCentro->nombre = $request->nombre;
        $sCentro->save();
        return $sCentro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SCentro  $sCentro
     * @return \Illuminate\Http\Response
     */
    public function show(SCentro $sCentro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SCentro  $sCentro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SCentro $sCentro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SCentro  $sCentro
     * @return \Illuminate\Http\Response
     */
    public function destroy(SCentro $sCentro)
    {
        //
    }
}
