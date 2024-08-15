<?php

namespace App\Http\Controllers;

use App\Models\Traspaso;
use App\Models\TraspasoInventario;
use App\Models\Inventario;
use Illuminate\Http\Request;

class TraspasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traspaso = Traspaso::orderBy('fecha','desc')->where('estado',1)->with(['Documento','Metodo','Bodega'])->get();
        
        $list=[];
        foreach($traspaso as $m){
            $list[]=$this->show($m);
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
        $traspaso = new Traspaso();
        $traspaso->fecha=$request->fecha;
        $traspaso->empresa_id=$request->empresa_id;
        $traspaso->sucursal_id=$request->sucursal_id;
        $traspaso->motivo=$request->motivo;
        $traspaso->bodega_id=$request->bodega_id;
        $traspaso->documento_id=$request->documento_id;
        $traspaso->referencia=$request->referencia;
        $traspaso->t_neto=$request->t_neto;
        $traspaso->t_impuesto=$request->t_impuesto;
        $traspaso->total=$request->total;
        $traspaso->t_compra=$request->t_compra;
        $traspaso->tipo=$request->tipo;      
        $traspaso->usuario_id=$request->usuario_id;              
        $traspaso->save();
        $numero = Traspaso::all()->count();
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $articulo = $m['articulo'];
        $inventario = new Inventario();
        $inventario->articulo_id = $articulo['id'];
        $inventario->tipo = $traspaso['tipo'];
        $inventario->fecha = $traspaso['fecha'];
        $inventario->compra = $m['precioc'];
        $inventario->venta = $m['precio'];
        $inventario->impuesto = $m['porcentaje'];
        $inventario->total = $m['precio']+$m['precio']*$m['porcentaje'];
        $inventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $inventario->bodega_id = $articulo['bodega_id'];
        $inventario->cantidad = $m['cantidad'];
        $inventario->motivo = "traspaso #".$numero;
        $inventario->save();
        $traspasoInventario = new TraspasoInventario();
        $traspasoInventario->inventario_id = $inventario->id;
        $traspasoInventario->venta_id = $traspaso->id;
        $traspasoInventario->articulo_id = $articulo['id'];
        $traspasoInventario->neto = $m['precio'];
        $traspasoInventario->cantidad = $m['cantidad'];
        $traspasoInventario->precioc = $m['precioc']; 
        $traspasoInventario->precio = $m['precio']+$m['precio']*$m['porcentaje'];
        $traspasoInventario->impuesto = $m['porcentaje'];
        $traspasoInventario->v_impuesto = $m['precio']*$m['porcentaje'];
        $traspasoInventario->tipo = $traspaso['tipo'];
        $traspasoInventario->save();
                 }
            }
        }
        return $traspaso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function show(Traspaso $traspaso)
    {
        $traspaso->cliente = $traspaso->Cliente;
        $traspaso->metodo = $traspaso->Metodo;
        $traspaso->documento = $traspaso->Documento;
        $traspaso->traspaso_inventarios = $traspaso->TraspasoInventario()->with(['Inventario'=>function($i){
            $i->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria','Medida','Bodega']);
            }]);
        }])->get();
        return $traspaso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traspaso $traspaso)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Traspaso  $traspaso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traspaso $traspaso)
    {
        $traspaso->estado =0;
        $traspaso->save();
    }
}
