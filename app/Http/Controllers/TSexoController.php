<?php

namespace App\Http\Controllers;

use App\Models\TSexo;
use Illuminate\Http\Request;

class TSexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TSexo::where('estado',1)->get();
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
     * @param  \App\Models\TSexo  $tSexo
     * @return \Illuminate\Http\Response
     */
    public function show(TSexo $tSexo)
    {
        return $tSexo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TSexo  $tSexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TSexo $tSexo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TSexo  $tSexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TSexo $tSexo)
    {
        //
    }
}
