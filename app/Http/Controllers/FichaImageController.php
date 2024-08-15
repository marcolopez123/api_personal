<?php

namespace App\Http\Controllers;

use App\Models\FichaImage;
use App\Models\Trabajador;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FichaImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Trabajador $trabajador)
    {
        $file = $request->file('file')->store('public/imagenes');
        $url = Storage::url($file);
        $image = new Image();
        $image->path = $url;
        $image->save();
        $FichaImage = new FichaImage();
        $FichaImage->image_id = $image->id;
        $FichaImage->trabajador_id = $trabajador->id;
        $FichaImage->save();
        return $FichaImage;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FichaImage  $fichaImage
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        $trabajador->ficha_image = $trabajador->FichaImages()->get()->each(function($i){
            $i->url = $i->image->UrlImage();
        });
        return $trabajador;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FichaImage  $fichaImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FichaImage $fichaImage)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FichaImage  $fichaImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaImage $fichaImage)
    {
        $fichaImage->estado = 0;
        $fichaImage->save();
    }
}
