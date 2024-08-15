<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Articulo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedido = Pedido::orderBy('fecha','desc')->where('sucursal_id','<>',2)->where('estado',1)->with(['Cliente'])->get();
        
        $list=[];
        foreach($pedido as $m){
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
        $pedido = new Pedido();
        $pedido->cliente_id=$request->cliente_id;
        if($pedido->fecha  = $request->fecha == null ){
            $pedido->fecha= now()->format('Y-m-d');
         }else{
            $pedido->fecha=$request->fecha;
         }
        $pedido->usuario_id=$request->usuario_id;
        $pedido->empresa_id=$request->empresa_id;
        $pedido->sucursal_id=$request->sucursal_id;
        $pedido->pendiente=$request->total;
        $pedido->save();
        if(isset($request->carrito)){
            if(!empty($request->carrito)){
                foreach($request->carrito as $m){
        $articulo = $m['articulo'];
        $pedidoDetalle = new PedidoDetalle();
        $pedidoDetalle->pedido_id = $pedido->id;
        $pedidoDetalle->pedido = $pedido->id;
        $pedidoDetalle->articulo_id = $articulo['id'];
        $pedidoDetalle->fecha = $pedido['fecha'];
        $pedidoDetalle->precioc = $m['precioc'];
        $pedidoDetalle->precio = $m['precio'];
        $pedidoDetalle->impuesto = $m['porcentaje'];
        $pedidoDetalle->kilos = $m['kilos'];
        $pedidoDetalle->v_impuesto = $m['precio']*$m['porcentaje'];
        $pedidoDetalle->bodega_id = $articulo['bodega_id'];
        $pedidoDetalle->cantidad = $m['cantidad'];
        $pedidoDetalle->pendiente = $m['cantidad'];
        $pedidoDetalle->save();
                }
            }
        }
        return $this->show($pedido);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        $pedido->cliente = $pedido->Cliente;
        $pedido->pedido_detalles = $pedido->PedidoDetalle()->with(['Articulo'=>function($a){
                $a->with(['Marca','Categoria','Medida','Bodega']);
            }])->get();

        
        $pedido->url_pdf = url('api/reportes/pedidos/'.$pedido->id);
        return $pedido;
    }

    public function pdf(Pedido $pedido)
    {
        $pedido = $this->show($pedido);
        $pdf = PDF::loadView('reports.pedido', ["pedido"=>$pedido]);
        return $pdf->stream();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
