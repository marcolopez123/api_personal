<?php

namespace App\Http\Controllers;

use App\Models\Metodo;
use Illuminate\Http\Request;

class MetodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Metodo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $metodo = new Metodo();
        $metodo->nombre = $request->nombre;
        $metodo->save();
        return $metodo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function show(Metodo $metodo)
    {
        return $metodo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metodo $metodo)
    {
        $metodo->nombre = $request->nombre;
        $metodo->save();
        return $metodo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metodo $metodo)
    {
        $metodo->estado = 0;
        $metodo->save();
    }
}
