<?php

namespace App\Http\Controllers;

use App\Models\RespaldoDocto;
use App\Models\Respaldo;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RespaldoDoctoController extends Controller
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
    public function store(Request $request ,Respaldo $respaldo)
    {
        $file = $request->file('file')->store('public/documentos');
        $url = Storage::url($file);
        $documento = new Documento();
        $documento->path = $url;
        $documento->save();
        $RespaldoDocto = new RespaldoDocto();
        $RespaldoDocto->documento_id = $documento->id;
        $RespaldoDocto->respaldo_id = $respaldo->id;
        $RespaldoDocto->save();
        return $RespaldoDocto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RespaldoDocto  $respaldoDocto
     * @return \Illuminate\Http\Response
     */
    public function show(RespaldoDocto $respaldoDocto)
    {
        $respaldo->respaldo_docto = $respaldo->RespaldoDoctos()->get()->each(function($i){
            $i->url = $i->documento->UrlDocumento();
        });
        return $respaldo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RespaldoDocto  $respaldoDocto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RespaldoDocto $respaldoDocto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RespaldoDocto  $respaldoDocto
     * @return \Illuminate\Http\Response
     */
    public function destroy(RespaldoDocto $respaldoDocto)
    {
        $respaldoDocto->estado = 0;
        $respaldoDocto->save();
    }
}
