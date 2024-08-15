<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Archivo::with(['Trabajador','TipoArchivo'])->where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list; 
    }
    public function Trabajador(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Archivo::with(['Trabajador','TipoArchivo'])->where('estado',1)->where('trabajador_id',$trabajador)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }
    public function FiltroContrato(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Archivo::with(['Trabajador','TipoArchivo'])->where('tipo_archivo_id','<=',2)->where('estado',1)->where('trabajador_id',$trabajador)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }
    public function FiltroRegistro(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Archivo::with(['Trabajador','TipoArchivo'])->where('tipo_archivo_id','>',2)->where('estado',1)->where('trabajador_id',$trabajador)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }
    public function FiltroArea(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Archivo::with(['Trabajador','TipoArchivo'])->where('area_id','=',3)->where('estado',1)->where('trabajador_id',$trabajador)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $archivo = new Archivo();
        $archivo->trabajador_id = $request->trabajador_id;
        $archivo->area_id = $request->area_id;
        $archivo->tipo_archivo_id = $request->tipo_archivo_id;
        $archivo->comentario = $request->comentario;
        $archivo->save();
        return $archivo; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        $archivo->trabajador = $archivo->Trabajador;
        $archivo->tipoArchivo = $archivo->TipoArchivo;
        return $archivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        $archivo->comentario = $request->comentario;
        $archivo->tipo_archivo_id = $request->tipo_archivo_id;
        $archivo->save();
        return $archivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivo $archivo)
    {
        $archivo->estado = 0;
        $archivo->save();
        return $archivo;
    }
    public function Documento(Archivo $archivo)
    {
        

        
        $archivo->trabajador = $archivo->Trabajador;
        $archivo->tipoArchivo = $archivo->TipoArchivo;
        $archivo->documento = $archivo->ArchivoDoctos()->get()->first();
        if($archivo->documento!=null){
           $archivo->documento->url = $archivo->documento->documento->UrlDocumento();
        }       
        return $archivo;
    }
}
