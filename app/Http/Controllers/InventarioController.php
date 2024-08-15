<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Articulo; 
use App\Models\Bodega; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Articulo::with(['Bodega','Categoria','Medida','Marca'])->where('estado',1)->orderBy('nombre')->get();
     
    }

    public function inventario()
    {
        
        {
        
            $model= Articulo::where('estado',1)->orderBy('nombre')->get();
            $list = [];
            foreach($model as $m){
                $list[] = $this->kardex($m);
            }
            return $list;
        }
       
    }
    public function categoria()
    {
        
        {
        
            $model= Articulo::where('estado',1)->orderBy('nombre')->get();
            $list = [];
            foreach($model as $m){
                $list[] = $this->Kardex3($m);
            }
            return $list;
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function Kardex(Articulo $articulo)
     {
         

         $articulo->marca = $articulo->Marca;
         $articulo->medida = $articulo->Medida;
         $articulo->bodega = $articulo->Bodega;
         $articulo->categoria = $articulo->Categoria;
         $articulo->image = $articulo->ArticuloImages()->get()->first();
         if($articulo->image!=null){
            $articulo->image->url = $articulo->image->image->UrlImage();
         }
         $articulo->inventarios = $articulo->Inventarios()->where('estado',1)->get();
         $articulo->inventarios = $articulo->Inventarios()->orderBy('fecha','DESC')->get();
         $articulo->egresos = $articulo->inventarios->where('tipo',2)->where('tipo',3)->sum('venta');
         $articulo->cantidad = $articulo->inventarios->where('tipo',2)->where('tipo',3)->sum('cantidad');
         $articulo->valorizado = $articulo->stock * $articulo->venta;
         $articulo->inversion = $articulo->stock * $articulo->compra;
         $articulo->c_stock = $articulo->c_stock;
         $articulo->ganancia = $articulo->valorizado - $articulo->inversion;
         return $articulo;
     }

     public function Kardex2(Bodega $bodega)
     {
         $bodega->marca = $bodega->Marca;
         $bodega->medida = $bodega->Medida;
         $bodega->categoria = $bodega->Categoria;
         $bodega->inventarios = $bodega->Inventarios()->where('estado',1)->get();
         $bodega->ingresos = $bodega->inventarios->where('tipo',1)->sum('cantidad');
         $bodega->egresos = $bodega->inventarios->where('tipo',2)->sum('cantidad');
         $bodega->stock = $bodega->ingresos - $bodega->egresos;
         $bodega->valorizado = $bodega->stock * $bodega->venta;
         $bodega->inversion = $bodega->stock * $bodega->compra;
         $bodega->ganancia = $bodega->valorizado - $bodega->inversion;
         return $bodega;
     }
     public function Kardex3(Articulo $articulo)
     {

        $articulo->marca = $articulo->Marca;
        $articulo->medida = $articulo->Medida;
        $articulo->bodega = $articulo->Bodega;
        $articulo->categoria = $articulo->Categoria;
        $articulo->inventarios = $articulo->Inventarios()->where('estado',1)->get();
        $articulo->inventarios = $articulo->Inventarios()->orderBy('fecha','DESC')->get();
        $articulo->egresos = $articulo->inventarios->where('tipo',2)->sum('venta');
        $articulo->cantidad = $articulo->inventarios->where('tipo',2)->sum('cantidad');
        $articulo->ventatotal = $articulo->inventarios->where('tipo',2)->sum('venta')*$articulo->inventarios->where('tipo',2)->sum('cantidad');
        return $articulo;
     }
    public function store(Request $request)
    {
        $inventario = new Inventario();
        $inventario->articulo_id = $request->articulo_id;
        $inventario->bodega_id = $request->bodega_id;
        $inventario->fecha = $request->fecha;
        $inventario->tipo = $request->tipo;
        $inventario->compra = $request->compra;
        $inventario->venta = $request->venta;
        $inventario->total = $request->compra + $request->venta;
        $inventario->impuesto = 0;
        $inventario->v_impuesto = 0;
        $inventario->cantidad = $request->cantidad;
        $inventario->motivo = $request->motivo;
        $inventario->save();
        return $inventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        $inventario->bodega_id = $inventario->User;
        return $inventario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->estado=0;
        $inventario->save();
    }
}
