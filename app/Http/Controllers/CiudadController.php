<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Comuna;
use App\Models\Region;
use App\Models\Pais;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ciudad::with(['Pais','Region','Comuna'])->orderBy('nombre')->where('estado',1)->get();
    }
    public function Filtro(Request $request)
    {
        return Ciudad::with(['Pais','Region','Comuna'])->orderBy('nombre')->where('comuna_id','=', $request->filtro)->where('estado',1)->get();
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ciudad = new Ciudad();
        $ciudad->nombre = $request->nombre;
        $ciudad->pais_id = $request->pais_id;
        $ciudad->region_id = $request->region_id;
        $ciudad->comuna_id = $request->comuna_id;
        $ciudad->save();
        return $ciudad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudad $ciudad)
    {
        return $ciudad;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciudad $ciudad)
    {
        $ciudad->nombre = $request->nombre;
        $ciudad->pais_id = $request->pais_id;
        $ciudad->region_id = $request->region_id;
        $ciudad->comuna_id = $request->comuna_id;
        $ciudad->save();
        return $ciudad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudad)
    {
        $ciudad->estado = 0;
        $ciudad->save();
    }
}
