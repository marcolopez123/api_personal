<?php

namespace App\Http\Controllers;

use App\Models\TPPrevisione;
use Illuminate\Http\Request;

class TPPrevisioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  TPPrevisione::where('estado',1)->orderBy('id')->get();
    }
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return  TPPrevisione::where('t_periodo_id',$filtro)->orderBy('id')->get();
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
     * @param  \App\Models\TPPrevisione  $tPPrevisione
     * @return \Illuminate\Http\Response
     */
    public function show(TPPrevisione $tPPrevisione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPPrevisione  $tPPrevisione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPPrevisione $tPPrevisione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPPrevisione  $tPPrevisione
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPPrevisione $tPPrevisione)
    {
        //
    }
}
