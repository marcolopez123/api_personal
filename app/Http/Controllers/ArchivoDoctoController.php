<?php

namespace App\Http\Controllers;

use App\Models\ArchivoDocto;
use App\Models\Archivo;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArchivoDoctoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Archivo $archivo)
    {
        $file = $request->file('file')->store('public/documentos');
        $url = Storage::url($file);
        $documento = new Documento();
        $documento->path = $url;
        $documento->save();
        $ArchivoDocto = new ArchivoDocto();
        $ArchivoDocto->documento_id = $documento->id;
        $ArchivoDocto->archivo_id = $archivo->id;
        $ArchivoDocto->save();
        return $ArchivoDocto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        $archivo->archivo_docto = $archivo->ArchivoDoctos()->get()->each(function($i){
            $i->url = $i->documento->UrlDocumento();
        });
        return $archivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchivoDocto $archivoDocto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArchivoDocto $archivoDocto)
    {
        $liquidacionDocto->estado = 0;
        $liquidacionDocto->save();
    
    }
}
