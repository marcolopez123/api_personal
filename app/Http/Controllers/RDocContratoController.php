<?php

namespace App\Http\Controllers;

use App\Models\RDocContrato;
use Illuminate\Http\Request;

class RDocContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RDocContrato::where('estado',1)->orderBy('nombre')->get();
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
     * @param  \App\Models\RDocContrato  $rDocContrato
     * @return \Illuminate\Http\Response
     */
    public function show(RDocContrato $rDocContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RDocContrato  $rDocContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RDocContrato $rDocContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RDocContrato  $rDocContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(RDocContrato $rDocContrato)
    {
        //
    }
}
