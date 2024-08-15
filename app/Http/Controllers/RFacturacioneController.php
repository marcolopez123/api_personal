<?php

namespace App\Http\Controllers;

use App\Models\RFacturacione;
use Illuminate\Http\Request;

class RFacturacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= RFacturacione::with(['Cliente','TipoArchivo'])->where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list; 
    }

    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        $model= RFacturacione::with(['Cliente','TipoArchivo'])->where('estado',1)->where('facturacione_id',$filtro)->get();
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
        $rFacturacione = new RFacturacione();
        $rFacturacione->cliente_id = $request->cliente_id;
        $rFacturacione->area_id = $request->area_id;
        $rFacturacione->empresa_id = $request->empresa_id;
        $rFacturacione->facturacione_id = $request->r_facturacione_id;
        $rFacturacione->sucursal_id = $request->sucursal_id;
        $rFacturacione->tipo_archivo_id = $request->tipo_archivo_id;
        $rFacturacione->comentario = $request->comentario;
        $rFacturacione->save();
        return $rFacturacione; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RFacturacione  $rFacturacione
     * @return \Illuminate\Http\Response
     */
    public function show(RFacturacione $rFacturacione)
    {
        $rFacturacione->cliente = $rFacturacione->Clientes;
        $rFacturacione->tipoArchivo = $rFacturacione->TipoArchivo;
        return $rFacturacione;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RFacturacione  $rFacturacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RFacturacione $rFacturacione)
    {
        $rFacturacione->cliente_id = $request->cliente_id;
        $rFacturacione->comentario = $request->comentario;
        $rFacturacione->tipo_archivo_id = $request->tipo_archivo_id;
        $rFacturacione->save();
        return $rFacturacione;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RFacturacione  $rFacturacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(RFacturacione $rFacturacione)
    {
        $rFacturacione->estado = 0;
        $rFacturacione->save();
  
    }

    public function Documento(RFacturacione $rFacturacione)
    {
        

        
        $rFacturacione->cliente = $rFacturacione->Cliente;
        $rFacturacione->tipoArchivo = $rFacturacione->TipoArchivo;
        $rFacturacione->documento = $rFacturacione->RespaldoFacturacione()->get()->first();
        if($rFacturacione->documento!=null){
           $rFacturacione->documento->url = $rFacturacione->documento->documento->UrlDocumento();
        }       
        return $rFacturacione;
    }
}
