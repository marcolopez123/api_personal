<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\UserEmpresa;
use Illuminate\Http\Request;
use App\Tb_umedida;
use DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Empresa::with(['Pais','Region','Comuna','Ciudad'])->where('estado',1)->get();
    }

    public function filtro(Request $request)
    {
        $filtro = $request->filtro;
    
            $empresa = Empresa::leftjoin('empresas','user_empresas.empresa_id','=','empresas.id')->select('id')
            ->get();
            return ['empresa'=>$empresa];
    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->rut = $request->rut;
        $empresa->razon_social = $request->razon_social;
        $empresa->pais_id = $request->pais_id;
        $empresa->region_id = $request->region_id;
        $empresa->comuna_id = $request->comuna_id;
        $empresa->ciudad_id = $request->ciudad_id;
        $empresa->direccion = $request->direccion;
        $empresa->ppm = $request->ppm;
        $empresa->save();
        $userEmpresa = new UserEmpresa();
        $userEmpresa->user_id = 1;
        $userEmpresa->empresa_id = $empresa->id;
        $userEmpresa->save();
        return $empresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        
        $empresa->pais = $empresa->Pais;
        $empresa->region = $empresa->Region;
        $empresa->comuna = $empresa->Comuna;
        $empresa->ciudad = $empresa->Ciudad;
        return $empresa;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $empresa->nombre = $request->nombre;
        $empresa->rut = $request->rut;
        $empresa->razon_social = $request->razon_social;
        $empresa->pais_id = $request->pais_id;
        $empresa->region_id = $request->region_id;
        $empresa->comuna_id = $request->comuna_id;
        $empresa->ciudad_id = $request->ciudad_id;
        $empresa->direccion = $request->direccion;
        $empresa->ppm = $request->ppm;
        $empresa->save();
        return $empresa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->estado = 0;
        $empresa->save();
    }
}
