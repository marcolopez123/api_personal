<?php

namespace App\Http\Controllers;

use App\Models\TEstadoCivile;
use Illuminate\Http\Request;

class TEstadoCivileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TEstadoCivile::where('estado',1)->get();
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
     * @param  \App\Models\TEstadoCivile  $tEstadoCivile
     * @return \Illuminate\Http\Response
     */
    public function show(TEstadoCivile $tEstadoCivile)
    {
        return $tEstadoCivile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TEstadoCivile  $tEstadoCivile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TEstadoCivile $tEstadoCivile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TEstadoCivile  $tEstadoCivile
     * @return \Illuminate\Http\Response
     */
    public function destroy(TEstadoCivile $tEstadoCivile)
    {
        //
    }
}
