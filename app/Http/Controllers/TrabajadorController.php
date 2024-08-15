<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\FichaImage;
use App\Models\Image;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Trabajador::with(['Empresa','Pais','Region','Comuna','Ciudad','Sucursal'])->where('estado',1)->orderBy('nombre')->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->imagen($m);
        }
        return $list;
    
    }

    public function filtro(Request $request)
    {
        $filtro = $request->filtro;
        $model= Trabajador::with(['Pais','Region','Comuna','Ciudad','Sucursal'])->where('id',$filtro)->where('estado',1)->orderBy('nombre')->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->imagen($m);
        }
        return $list;
    
    }
    public function empresa(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $model= Trabajador::with(['Pais','Region','Comuna','Ciudad','Sucursal'])->where('empresa_id',$filtro)->where('sucursal_id',$sucursal)->where('estado',1)->orderBy('nombre')->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->imagen($m);
        }
        return $list;
    
    }
    public function sucursal(Request $request)
    {
        $filtro = $request->filtro;
        $sucursal = $request->sucursal;
        $model= Trabajador::with(['Pais','Region','Comuna','Ciudad','Sucursal'])->where('sucursal_id',$sucursal)->where('estado',1)->orderBy('nombre')->get();
        $list = [];
        foreach($model as $m){
            $list[] = $this->imagen($m);
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
        $trabajador = new Trabajador();
        $trabajador->nombre = $request->nombre;
        $trabajador->a_paterno = $request->a_paterno;
        $trabajador->a_materno = $request->a_materno;
        $trabajador->rut = $request->rut;
        $trabajador->t_nacionalidade_id = $request->t_nacionalidade_id;
        $trabajador->t_sexo_id = $request->t_sexo_id;
        $trabajador->t_estado_civile_id = $request->t_estado_civile_id;
        $trabajador->pais_id = $request->pais_id;
        $trabajador->empresa_id = $request->empresa_id;
        $trabajador->sucursal_id = $request->sucursal_id;
        $trabajador->region_id = $request->region_id;
        $trabajador->comuna_id = $request->comuna_id;
        $trabajador->ciudad_id = $request->ciudad_id;
        $trabajador->direccion = $request->direccion;
        $trabajador->e_personal = $request->e_personal;
        $trabajador->e_institucional = $request->e_institucional;
        $trabajador->t_personal = $request->t_personal;
        $trabajador->t_emergencia = $request->t_emergencia;
        $trabajador->save();
        $image = new Image();
        $image->path = "/storage/imagenes/users.png";
        $image->save();
        $FichaImage = new FichaImage();
        $FichaImage->image_id = 1;
        $FichaImage->trabajador_id = $trabajador->id;
        $FichaImage->save();
        return $trabajador;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        $trabajador->pais = $trabajador->Pais;
        $trabajador->empresa = $trabajador->Empresa;
        $trabajador->sucursal = $trabajador->Sucursal;
        $trabajador->tNacionalidade = $trabajador->TNacionalidade;
        $trabajador->tSexo = $trabajador->TSexo;
        $trabajador->tEstadoCivile = $trabajador->tEstadoCivile;
        $trabajador->region = $trabajador->Region;
        $trabajador->comuna = $trabajador->Comuna;
        $trabajador->ciudad = $trabajador->Ciudad;
        $trabajador->image = $trabajador->Images;
        return $trabajador;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajador $trabajador)
    {
        $trabajador->nombre = $request->nombre;
        $trabajador->a_paterno = $request->a_paterno;
        $trabajador->a_materno = $request->a_materno;
        $trabajador->rut = $request->rut;
        $trabajador->t_nacionalidade_id = $request->t_nacionalidade_id;
        $trabajador->t_sexo_id = $request->t_sexo_id;
        $trabajador->t_estado_civile_id = $request->t_estado_civile_id;
        $trabajador->pais_id = $request->pais_id;
        $trabajador->region_id = $request->region_id;
        $trabajador->comuna_id = $request->comuna_id;
        $trabajador->ciudad_id = $request->ciudad_id;
        $trabajador->direccion = $request->direccion;
        $trabajador->e_personal = $request->e_personal;
        $trabajador->e_institucional = $request->e_institucional;
        $trabajador->t_personal = $request->t_personal;
        $trabajador->t_emergencia = $request->t_emergencia;
        $trabajador->save();
        return $trabajador;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajador $trabajador)
    {
        $trabajador->estado = 0;
        $trabajador->save();
    }
    public function Imagen(Trabajador $trabajador)
     {
         

        $trabajador->pais = $trabajador->Pais;
        $trabajador->empresa = $trabajador->Empresa;
        $trabajador->region = $trabajador->Region;
        $trabajador->comuna = $trabajador->Comuna;
        $trabajador->ciudad = $trabajador->Ciudad;
         $trabajador->image = $trabajador->FichaImages()->get()->first();
         if($trabajador->image!=null){
            $trabajador->image->url = $trabajador->image->image->UrlImage();
         }         
         return $trabajador;
     }
}
