<?php

namespace App\Http\Controllers;

use App\Models\tPermRole;
use App\Models\Role;
use Illuminate\Http\Request;

class TPermRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tPermRole::with(['Role'])->where('estado',1)->get();
    }
    public function Filtro(Request $request)
    {
        $filtro = $request->filtro;
        return  tPermRole::with(['Role'])->where('role_id',$filtro)->where('estado',1)->orderBy('nombre')->get();
    
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
     * @param  \App\Models\tPermRole  $tPermRole
     * @return \Illuminate\Http\Response
     */
    public function show(tPermRole $tPermRole)
    {
        $tPermRole->role = $tPermRole->Role;
        return $tPermRole;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tPermRole  $tPermRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tPermRole $tPermRole)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tPermRole  $tPermRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(tPermRole $tPermRole)
    {
        //
    }
}
