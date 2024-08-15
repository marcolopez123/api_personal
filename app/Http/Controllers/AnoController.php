<?php

namespace App\Http\Controllers;

use App\Models\Ano;
use Illuminate\Http\Request;

class AnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ano::where('estado',1)->get();
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
     * @param  \App\Models\Ano  $ano
     * @return \Illuminate\Http\Response
     */
    public function show(Ano $ano)
    {
        return $ano;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ano  $ano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ano $ano)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ano  $ano
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ano $ano)
    {
        //
    }
}
