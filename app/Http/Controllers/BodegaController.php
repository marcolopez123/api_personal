<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bodega::with(['Empresa','Sucursal'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bodega = new Bodega();
        $bodega->nombre = $request->nombre;
        $bodega->empresa_id = $request->empresa_id;
        $bodega->sucursal_id = $request->sucursal_id;
        $bodega->save();
        return $bodega;
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function show(Bodega $bodega)
    {
        $bodega->empresa = $bodega->Empresa;
        $bodega->sucursal = $bodega->Sucursal;
        return $bodega;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bodega $bodega)
    {
        $bodega->nombre = $request->nombre;
        $bodega->empresa_id = $request->empresa_id;
        $bodega->sucursal_id = $request->sucursal_id;
        $bodega->save();
        return $bodega;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bodega $bodega)
    {
        $bodega->estado = 0;
        $bodega->save();
    }
}
