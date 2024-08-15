<?php

namespace App\Http\Controllers;

use App\Models\LiquidacionDocto;
use App\Models\Liquidacion;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LiquidacionDoctoController extends Controller
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
    public function store(Request $request,Liquidacion $liquidacion)
    {
        $file = $request->file('file')->store('public/documentos');
        $url = Storage::url($file);
        $documento = new Documento();
        $documento->path = $url;
        $documento->save();
        $LiquidacionDocto = new LiquidacionDocto();
        $LiquidacionDocto->documento_id = $documento->id;
        $LiquidacionDocto->liquidacion_id = $liquidacion->id;
        $LiquidacionDocto->save();
        return $LiquidacionDocto;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiquidacionDocto  $liquidacionDocto
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacion $liquidacion)
    {
        $liquidacion->liquidacion_documento = $liquidacion->LiquidacionDoctos()->get()->each(function($i){
            $i->url = $i->documento->UrlDocumento();
        });
        return $liquidacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiquidacionDocto  $liquidacionDocto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquidacionDocto $liquidacionDocto)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiquidacionDocto  $liquidacionDocto
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiquidacionDocto $liquidacionDocto)
    {
        $liquidacionDocto->estado = 0;
        $liquidacionDocto->save();
    }
    public function descarga(LiquidacionDocto $liquidaciondocto) {
        return response()->download(public_path(Storage::url($liquidaciondocto->url)), $liquidaciondocto->title);
    }
}
