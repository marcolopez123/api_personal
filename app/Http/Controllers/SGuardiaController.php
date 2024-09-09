<?php

namespace App\Http\Controllers;

use App\Models\SGuardia;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class SGuardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SGuardia::with(['Empresa','Sucursal','Trabajador'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SGuardia  $sGuardia
     * @return \Illuminate\Http\Response
     */
    public function show(SGuardia $sGuardia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SGuardia  $sGuardia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SGuardia $sGuardia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SGuardia  $sGuardia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SGuardia $sGuardia)
    {
        //
    }
}
