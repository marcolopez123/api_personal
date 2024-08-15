<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Pais;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Region::with(['Pais',])->orderBy('nombre')->where('estado',1)->get();
    
    }
    public function Filtro(Request $request)
    {
        return Region::with(['Pais',])->orderBy('nombre')->where('pais_id','=', $request->filtro)->where('estado',1)->get();
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $region = new region();
        $region->nombre = $request->nombre;
        $region->pais_id = $request->pais_id;
        $region->save();
        return $region;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return $region;
    }

    public function Regionpais(Pais $pais)
     {
         $pais->nombre = $pais->Nombre;
         $pais->regiones = $pais->Regiones()->where('estado',1)->get();
         return $pais;
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->nombre = $request->nombre;
        $region->pais_id = $request->pais_id;
        $region->save();
        return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->estado = 0;
        $region->save();
    }
}
