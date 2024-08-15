<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proveedor::with(['Pais','Region','Comuna','Ciudad','Empresa','Sucursal','User'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->empresa_id = $request->empresa_id;
        $proveedor->nombre = $request->nombre;
        $proveedor->rut = $request->rut;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->email = $request->email;
        $proveedor->fono = $request->fono;
        $proveedor->pais_id = $request->pais_id;
        $proveedor->region_id = $request->region_id;
        $proveedor->comuna_id = $request->comuna_id;
        $proveedor->ciudad_id = $request->ciudad_id;
        $proveedor->direccion = $request->direccion;
        $proveedor->usuario_id = $request->usuario_id;
        $proveedor->save();
        return $proveedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        $proveedor->pais = $proveedor->Pais;
        $proveedor->region = $proveedor->Region;
        $proveedor->comuna = $proveedor->Comuna;
        $proveedor->ciudad = $proveedor->Ciudad;
        $proveedor->empresa = $proveedor->empresa;
        $proveedor->sucursal = $proveedor->sucursal;
        $proveedor->user = $proveedor->user;
        return $proveedor;
    }

    public function selectProeveedor(request $request){
        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $proveedor = Proveedor::where('estado','=','1')
        ->select('id','proveedor','estado')
        ->orderBy('proveedor','asc')
        ->get();
        return ['proveedor'=> $proveedor];

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->empresa_id = $request->empresa_id;
        $proveedor->sucursal_id = $request->sucursal_id;
        $proveedor->nombre = $request->nombre;
        $proveedor->rut = $request->rut;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->email = $request->email;
        $proveedor->fono = $request->fono;
        $proveedor->pais_id = $request->pais_id;
        $proveedor->region_id = $request->region_id;
        $proveedor->comuna_id = $request->comuna_id;
        $proveedor->ciudad_id = $request->ciudad_id;
        $proveedor->direccion = $request->direccion;
        $proveedor->usuario_id = $request->usuario_id;
        $proveedor->save();
        return $proveedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->estado = 0;
        $proveedor->save();
    }
}
