<?php

namespace App\Http\Controllers;

use App\Models\TNacionalidade;
use Illuminate\Http\Request;

class TNacionalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TNacionalidade::where('estado',1)->get();
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
     * @param  \App\Models\TNacionalidade  $tNacionalidade
     * @return \Illuminate\Http\Response
     */
    public function show(TNacionalidade $tNacionalidade)
    {
        return $tNacionalidade;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TNacionalidade  $tNacionalidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TNacionalidade $tNacionalidade)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TNacionalidade  $tNacionalidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(TNacionalidade $tNacionalidade)
    {
        //
    }
}
