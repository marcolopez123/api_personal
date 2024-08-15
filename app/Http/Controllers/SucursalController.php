<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\UserSucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sucursal::with(['Pais','Region','Comuna','Ciudad','Empresa'])->where('estado',1)->get();
    }

    public function Empresa(Request $request)
    {
        $empresa = $request->empresa;
        return Sucursal::with(['Pais','Region','Comuna','Ciudad','Empresa'])->where('estado',1)->where('empresa_id',$empresa)->get();
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->empresa_id = $request->empresa_id;
        $sucursal->pais_id = $request->pais_id;
        $sucursal->region_id = $request->region_id;
        $sucursal->comuna_id = $request->comuna_id;
        $sucursal->ciudad_id = $request->ciudad_id;
        $sucursal->save();
        $userSucursal = new UserSucursal();
        $userSucursal->user_id = 1;
        $userSucursal->empresa_id = $request->empresa_id;
        $userSucursal->sucursal_id = $sucursal->id;
        $userSucursal->save();
        return $sucursal;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {   
        $sucursal->empresa = $sucursal->Empresa;
        $sucursal->pais = $sucursal->Pais;
        $sucursal->region = $sucursal->Region;
        $sucursal->comuna = $sucursal->Comuna;
        $sucursal->ciudad = $sucursal->Ciudad;
        return $sucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->empresa_id = $request->empresa_id;
        $sucursal->pais_id = $request->pais_id;
        $sucursal->region_id = $request->region_id;
        $sucursal->comuna_id = $request->comuna_id;
        $sucursal->ciudad_id = $request->ciudad_id;
        $sucursal->save();
        return $sucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        //
    }
}
