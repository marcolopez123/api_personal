<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Tesoreria;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::with(['Pais','Region','Comuna','Ciudad'])->where('estado',1)->orderBy('razon_social','asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->rut = $request->rut;
        $cliente->razon_social = $request->razon_social;
        $cliente->pais_id = $request->pais_id;
        $cliente->region_id = $request->region_id;
        $cliente->comuna_id = $request->comuna_id;
        $cliente->ciudad_id = $request->ciudad_id;
        $cliente->direccion = $request->direccion;     
        $cliente->save();
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $cliente->pais = $cliente->Pais;
        $cliente->region = $cliente->Region;
        $cliente->comuna = $cliente->Comuna;
        $cliente->ciudad = $cliente->Ciudad;
        $cliente->empresa = $cliente->empresa;
        $cliente->sucursal = $cliente->sucursal;
        $cliente->user = $cliente->user;
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->nombre = $request->nombre;
        $cliente->rut = $request->rut;
        $cliente->razon_social = $request->razon_social;
        $cliente->pais_id = $request->pais_id;
        $cliente->region_id = $request->region_id;
        $cliente->comuna_id = $request->comuna_id;
        $cliente->ciudad_id = $request->ciudad_id;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->estado = 0;
        $cliente->save();
    }
}
