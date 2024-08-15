<?php

namespace App\Http\Controllers;

use App\Models\Tesoreria;
use App\Models\Cliente;
use App\Models\Venta; 
use App\Models\Metodo; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;


class TesoreriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Cliente::where('estado',1)->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->pagos($m);
        }
        return $list;
        
    }

    public function pagos(Cliente $cliente)
     {
         

         $cliente->tesorerias = $cliente->Tesorerias()->where('metodo_id','<>','2')->where('estado',1)->with(['Metodo'])->orderBy('fecha','DESC')->get();
         return $cliente;
     }

     public function cajadia(Request $request)
     {
        return Tesoreria::where('user_id', '=' , $request->user)->where('fecha', '>=' , $request->fecha1)->where('fecha', '<=' , $request->fecha2)->with(['Metodo'])->orderBy('fecha','DESC')->get();
         
       
     }

     public function cajadia2(Request $request)
     {
        return Tesoreria::select('user_id','metodo_id',DB::raw('SUM(pago) as pago'))
        ->with(['Metodo'])
        ->where('user_id', '=' , $request->user)
        ->where('fecha', '=' , $request->fecha1)
        ->where('fecha', '<=' , $request->fecha2)
        ->groupBy('user_id')
        ->groupBy('metodo_id')
       
        ->get();

       
     }
     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tesoreria = new Tesoreria();
        $tesoreria->cliente_id=$request->cliente_id;
        $tesoreria->t_mov= 1;
        $tesoreria->metodo_id=$request->metodo_id;
        $tesoreria->referencia=$request->referencia;
        $tesoreria->pago=$request->pago;
        $tesoreria->fecha=$request->fecha;
        $tesoreria->user_id=$request->user_id;
        $tesoreria->save();
        return $tesoreria;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tesoreria  $tesoreria
     * @return \Illuminate\Http\Response
     */
    public function show(Tesoreria $tesoreria)
    {
        $tesoreria->documento = $tesoreria->Documento;
        $tesoreria->metodo = $tesoreria->Metodo;
        $tesoreria->user = $tesoreria->User;
        return $tesoreria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tesoreria  $tesoreria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tesoreria $tesoreria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tesoreria  $tesoreria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tesoreria $tesoreria)
    {
        //
    }
}
