<?php

namespace App\Http\Controllers;

use App\Models\Liquidacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model= Liquidacion::with(['Trabajador','Ano','Mese'])->where('estado',1)->orderBy('ano_id')->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }

    public function Trabajador(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Liquidacion::with(['Trabajador','Ano','Mese'])
        ->leftjoin('trabajadors','liquidacions.trabajador_id','=','trabajadors.id')
        ->leftjoin('anos','liquidacions.ano_id','=','anos.id')
        ->leftjoin('meses','liquidacions.mese_id','=','meses.id')
        ->select('liquidacions.id',
                 'liquidacions.trabajador_id',
                 'liquidacions.ano_id',
                 'liquidacions.mese_id',
                 'trabajadors.nombre as n_trabajador',
                 'anos.nro as n_ano',
                 'meses.nro as n_mes',
                 'liquidacions.estado')
        ->where('liquidacions.estado',1)->where('liquidacions.trabajador_id',$trabajador)
        ->orderBy('ano_id')
        ->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->Documento($m);
        }
        return $list;

    }
    public function Trabajador2(Request $request)
    {
        $trabajador = $request->trabajador;
        $model= Liquidacion::with(['Trabajador','Ano','Mese'])
        ->leftjoin('trabajadors','liquidacions.trabajador_id','=','trabajadors.id')
        ->leftjoin('anos','liquidacions.ano_id','=','anos.id')
        ->leftjoin('meses','liquidacions.mese_id','=','meses.id')
        ->select('liquidacions.id',
                 'liquidacions.trabajador_id',
                 'liquidacions.ano_id',
                 'liquidacions.mese_id',
                 'trabajadors.nombre as n_trabajador',
                 'anos.nro as n_ano',
                 'meses.nro as n_mes',
                 'liquidacions.estado')
        ->where('liquidacions.estado',1)->where('liquidacions.trabajador_id',$trabajador)
        ->orderBy('ano_id')
        ->get();
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
        $liquidacion = new Liquidacion();
        $liquidacion->trabajador_id = $request->trabajador_id;
        $liquidacion->mese_id = $request->mese_id;
        $liquidacion->ano_id = $request->ano_id;
        $liquidacion->save();
        return $liquidacion; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacion $liquidacion)
    {
        $liquidacion->mese = $liquidacion->Mese;
        $liquidacion->ano = $liquidacion->Ano;
        return $liquidacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        $liquidacion->trabajado_id = $request->trabajador_id;
        $liquidacion->mese_id = $request->mese_id;
        $liquidacion->ano_id = $request->ano_id;
        $liquidacion->save();
        return $liquidacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        $liquidacion->estado = 0;
        $liquidacion->save();
        return $liquidacion;
    }
    public function descarga(Liquidacion $liquidacion) {
        return response()->download(public_path(Storage::url($liquidacion->path)), $liquidacion->title);
    }
    public function Documento(Liquidacion $liquidacion)
     {
         

         $liquidacion->trabajador = $liquidacion->Trabajador;
         $liquidacion->mese = $liquidacion->Mese;
         $liquidacion->ano = $liquidacion->Ano;
         $liquidacion->documento = $liquidacion->LiquidacionDoctos()->get()->first();
         if($liquidacion->documento!=null){
            $liquidacion->documento->url = $liquidacion->documento->documento->UrlDocumento();
         }       
         return $liquidacion;
     }
}
