<?php

namespace App\Http\Controllers;

use App\Models\UserSucursal;
use Illuminate\Http\Request;

class UserSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserSucursal::with(['user','Empresa','Sucursal'])->where('estado',1)->get();
    }
    public function Usuario(Request $request)
    {
        $usuario = $request->usuario;
        return UserSucursal::with(['user','Empresa','Sucursal'])->where('estado',1)->where('user_id',$usuario)->get();
       

    }
    public function Empresa(Request $request)
    {
        $usuario = $request->usuario;
        $empresa = $request->empresa;
        return UserSucursal::with(['user','Empresa','Sucursal'])->where('estado',1)->where('user_id',$usuario)->where('empresa_id','=',$empresa)->get();
       

    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userSucursal = new UserSucursal();
        $userSucursal->user_id = $request->user_id;
        $userSucursal->empresa_id = $request->empresa_id;
        $userSucursal->sucursal_id = $request->sucursal_id;
        $userSucursal->save();
        return $userSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSucursal  $userSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(UserSucursal $userSucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSucursal  $userSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSucursal $userSucursal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSucursal  $userSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSucursal $userSucursal)
    {
        //
    }
}
