<?php

namespace App\Http\Controllers;

use App\Models\TPeriodoPrevicione;
use Illuminate\Http\Request;

class TPeriodoPrevicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  TPeriodoPrevicione::where('estado',1)->orderBy('id')->get();
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
     * @param  \App\Models\TPeriodoPrevicione  $tPeriodoPrevicione
     * @return \Illuminate\Http\Response
     */
    public function show(TPeriodoPrevicione $tPeriodoPrevicione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPeriodoPrevicione  $tPeriodoPrevicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TPeriodoPrevicione $tPeriodoPrevicione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TPeriodoPrevicione  $tPeriodoPrevicione
     * @return \Illuminate\Http\Response
     */
    public function destroy(TPeriodoPrevicione $tPeriodoPrevicione)
    {
        //
    }
}
