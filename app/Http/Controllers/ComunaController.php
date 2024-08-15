<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comuna::with(['Pais','Region'])->orderBy('nombre')->where('estado',1)->get();
    }
    public function Filtro(Request $request)
    {
        return Comuna::with(['Pais','Region'])->orderBy('nombre')->where('region_id','=', $request->filtro)->where('estado',1)->get();
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->nombre = $request->nombre;
        $comuna->pais_id = $request->pais_id;
        $comuna->region_id = $request->region_id;
        $comuna->save();
        return $comuna;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comuna  $comuna
     * @return \Illuminate\Http\Response
     */
    public function show(Comuna $comuna)
    {
        return $comuna;
    }
    public function Regioncomuna(Region $region)
    {
        $region->nombre = $region->Nombre;
        $region->comunas = $region->Comunas()->where('estado',1)->get();
        return $region;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comuna  $comuna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comuna $comuna)
    {
        $comuna->nombre = $request->nombre;
        $comuna->pais_id = $request->pais_id;
        $comuna->region_id = $request->region_id;
        $comuna->save();
        return $comuna;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comuna  $comuna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comuna $comuna)
    {
        $comuna->estado = 0;
        $comuna->save();
    }
}
