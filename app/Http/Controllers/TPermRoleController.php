<?php

namespace App\Http\Controllers;

use App\Models\tPermRole;
use App\Models\Role;
use App\Models\Menu;
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
    
        return tPermRole::select('t_perm_roles.*')
            ->join('menus', 't_perm_roles.menu_id', '=', 'menus.id') // Reemplaza 'menu_id' e 'id' con los nombres de columnas correctos
            ->with(['Role', 'Menu'])
            ->where('t_perm_roles.role_id', $filtro)
            ->where('t_perm_roles.estado', 1)
            ->orderBy('menus.nombre') // Ordenar por el nombre del menú
            ->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tPermRoles = new tPermRole();
        $tPermRoles->role_id = $request->role_id;
        $tPermRoles->menu_id = $request->menu_id;
        $tPermRoles->activo = $request->activo;
        $tPermRoles->validacion = $request->role_id . "-" . $request->menu_id ;
        $tPermRoles->save();
        return $tPermRoles;
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

        $tPermRole->activo = $request->activo;
        $tPermRole->save();
        return $tPermRole;
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
