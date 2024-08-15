<?php

namespace App\Http\Controllers;

use App\Models\UserEmpresa;
use Illuminate\Http\Request;

class UserEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return UserEmpresa::with(['user','Empresa'])->where('estado',1)->get();
    }
    public function Usuario(Request $request)
    {
        $usuario = $request->usuario;
        return UserEmpresa::with(['user','Empresa'])->where('estado',1)->where('user_id',$usuario)->get();
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userEmpresa = new UserEmpresa();
        $userEmpresa->user_id = $request->user_id;
        $userEmpresa->empresa_id = $request->empresa_id;
        $userEmpresa->save();
        return $userEmpresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEmpresa  $usersEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(UserEmpresa $userEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsersEmpresa  $usersEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEmpresa $userEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersEmpresa  $usersEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEmpresa $userEmpresa)
    {
        //
    }
}
