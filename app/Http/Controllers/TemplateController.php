<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Models\TipoArchivo;
use App\Models\Empresa;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Template::with(['TipoArchivo',])->where('estado',1)->orderBy('nombre')->get();
    }

    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return Template::with(['TipoArchivo'])->where('tipo_archivo_id', $filtro)->where('estado',1)->get();
    }

    public function Empresa(Request $request)
    {
        $filtro = $request->filtro;
        return Template::with(['TipoArchivo','Empresa'])->where('empresa_id', $filtro)->where('estado',1)->get();
    }
    public function id(Request $request)
    {
        $filtro = $request->filtro;
        return Template::with(['TipoArchivo','Empresa'])->where('id', $filtro)->where('estado',1)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $templates = new Template();
        $templates->nombre = $request->nombre;
        $templates->contenido = $request->contenido;
        $templates->tipo_archivo_id = $request->tipo_archivo_id;
        $templates->save();
        return $templates;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        $template->nombre = $request->nombre;
        $template->contenido = $request->contenido;
        $template->save();
        return $template;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
