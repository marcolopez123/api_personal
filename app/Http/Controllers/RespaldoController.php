<?php

namespace App\Http\Controllers;

use App\Models\Respaldo;
use Illuminate\Http\Request;

class RespaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Respaldo::with(['Empresa','TipoArchivo','Sucursal'])->where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list; 
    }
    public function Formulario29(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $tipoarchivo = $request->tipoarchivo;
        $model= Respaldo::with(['Empresa','TipoArchivo','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->where('tipo_archivo_id',$tipoarchivo)->where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list; 
    }
    public function Prevencion(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $model= Respaldo::with(['Empresa','TipoArchivo','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->where('area_id',3)->where('estado',1)->get();
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
        $respaldo = new Respaldo();
        $respaldo->empresa_id = $request->empresa_id;
        $respaldo->sucursal_id = $request->sucursal_id;
        $respaldo->area_id = $request->area_id;
        $respaldo->tipo_archivo_id = $request->tipo_archivo_id;
        $respaldo->comentario = $request->comentario;
        $respaldo->save();
        return $respaldo; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Respaldo  $respaldo
     * @return \Illuminate\Http\Response
     */
    public function show(Respaldo $respaldo)
    {
        
        $archivo->respaldo = $archivo->Respaldo;
        $archivo->tipoArchivo = $archivo->TipoArchivo;
        return $archivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Respaldo  $respaldo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Respaldo $respaldo)
    {
        $respaldo->empresa_id = $request->empresar_id;
        $respaldo->area_id = $request->area_id;
        $respaldo->tipo_archivo_id = $request->tipo_archivo_id;
        $respaldo->save();
        return $respaldo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Respaldo  $respaldo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Respaldo $respaldo)
    {
        $respaldo->estado = 0;
        $respaldo->save();
        return $respaldo;
    }
    public function Documento(Respaldo $respaldo)
    {
        

        
        $respaldo->trabajador = $respaldo->Trabajador;
        $respaldo->tipoArchivo = $respaldo->TipoArchivo;
        $respaldo->documento = $respaldo->RespaldoDoctos()->get()->first();
        if($respaldo->documento!=null){
            $respaldo->documento->url = $respaldo->documento->documento->UrlDocumento();
         }      
        return $respaldo;
    }
}
