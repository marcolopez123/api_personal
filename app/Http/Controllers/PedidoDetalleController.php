<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use App\Models\Inventario;
use App\Models\Articulo; 
use App\Models\Bodega; 
use App\Models\Categoria; 
use App\Models\Medida; 
use App\Models\Marca; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PedidoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Articulo::with(['Bodega','Categoria','Medida','Marca'])->where('stock','>',0)->where('estado',1)->get();
    }

    public function pedidos()
    {
        return PedidoDetalle::where('pendiente','>',0)->where('estado',1)->with(['Articulo'=>function($a){
            $a->with(['Marca','Categoria','Medida','Bodega']);
        }])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido_detalle  $pedido_detalle
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoDetalle $PedidoDetalle)
    {
        return $PedidoDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido_detalle  $pedido_detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoDetalle $PedidoDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido_detalle  $pedido_detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoDetalle $PedidoDetalle)
    {
        //
    }
}
