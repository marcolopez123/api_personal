<?php

namespace App\Http\Controllers;

use App\Models\Mese;
use Illuminate\Http\Request;

class MeseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mese::where('estado',1)->get();
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
     * @param  \App\Models\Mese  $mese
     * @return \Illuminate\Http\Response
     */
    public function show(Mese $mese)
    {
        return $mese;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mese  $mese
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mese $mese)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mese  $mese
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mese $mese)
    {
        //
    }
}
