<?php

namespace App\Http\Controllers;

use App\Models\TipoArchivo;
use App\Models\Area;
use Illuminate\Http\Request;

class TipoArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoArchivo::with(['Area'])->where('estado',1)->get();
    }

    public function area(Request $request)
    {
        $area = $request->area;
        return TipoArchivo::where('estado',1)->where('area_id',$area)->get();
       

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoArchivo = new TipoArchivo();
        $tipoArchivo->area_id = $request->area_id;
        $tipoArchivo->nombre = $request->nombre;
        $tipoArchivo->save();
        return $tipoArchivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoArchivo  $tipoArchivo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoArchivo $tipoArchivo)
    {
        return $tipoArchivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoArchivo  $tipoArchivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoArchivo $tipoArchivo)
    {
        $tipoArchivo->area_id = $request->area_id;
        $tipoArchivo->nombre = $request->nombre;
        $tipoArchivo->save();
        return $tipoArchivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoArchivo  $tipoArchivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoArchivo $tipoArchivo)
    {
        $tipoArchivo->estado = $request->nombre;
        $tipoArchivo->save();
        return $tipoArchivo;
    }
}
