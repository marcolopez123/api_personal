<?php

namespace App\Http\Controllers;

use App\Models\RespaldoFacturacione;
use App\Models\RFacturacione;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RespaldoFacturacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,RFacturacione $rFacturacione)
    {
        $file = $request->file('file')->store('public/documentos');
        $url = Storage::url($file);
        $documento = new Documento();
        $documento->path = $url;
        $documento->save();
        $RespaldoFacturacione = new RespaldoFacturacione();
        $RespaldoFacturacione->documento_id = $documento->id;
        $RespaldoFacturacione->r_facturacione_id = $rFacturacione->id;
        $RespaldoFacturacione->save();
        return $RespaldoFacturacione;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RespaldoFacturacione  $respaldoFacturacione
     * @return \Illuminate\Http\Response
     */
    public function show(RFacturacione $rFacturacione)
    {
        $rFacturacione->respaldo_facturacione = $rFacturacione->RespaldoFacturacione()->get()->each(function($i){
            $i->url = $i->documento->UrlDocumento();
        });
        return $rFacturacione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RespaldoFacturacione  $respaldoFacturacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RespaldoFacturacione $respaldoFacturacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RespaldoFacturacione  $respaldoFacturacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(RespaldoFacturacione $respaldoFacturacione)
    {
        //
    }
}
