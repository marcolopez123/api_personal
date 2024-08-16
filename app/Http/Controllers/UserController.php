<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Request\LoginFormRequest;
use App\Models\UserEmpresa;
use App\Models\UserSucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with(['Sucursal','Empresa','Role'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export() 
    {
        return Excel::download(new UsersExport, 'invoices.xlsx');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->nombre = $request->nombre;
        $user->s_nombre = $request->s_nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->empresa_id = $request->empresa_id;
        $user->n_empresa = $request->n_empresa;
        $user->sucursal_id = $request->sucursal_id;
        $user->n_sucursal = $request->n_sucursal;
        $user->rol_id = $request->rol_id;
        $user->save();
        $userEmpresa = new UserEmpresa();
        $userEmpresa->user_id = $user->id;
        $userEmpresa->empresa_id = $user->empresa_id;
        $userEmpresa->save();
        $userSucursal = new UserSucursal();
        $userSucursal->user_id = $user->id;
        $userSucursal->empresa_id = $user->empresa_id;
        $userSucursal->sucursal_id = $user->sucursal_id;
        $userSucursal->save();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->empresa = $user->Empresa;
        $user->sucursal = $user->Sucursal;
        $user->tesoreria = $user->Tesoreria;
        $user->role = $user->role;
        return $user;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->nombre = $request->nombre;
        $user->s_nombre = $request->s_nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->empresa_id = $request->empresa_id;
        $user->rol_id = $request->rol_id;
        $user->trabajador_id = $request->trabajador_id;
        $user->sucursal_id = $request->sucursal_id; 
        if(isset($request->password)){
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
        }
       
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
    }

    public function login(LoginFormRequest $request)
    {
        if(Auth::attempt(['username'=>$request->username,'password'=>$request->password],false)){
            $user = Auth::user();
            
            return $user;
        }else{
            return response()->json(['errors'=>['login'=>['los datos no son validos']]]);
        }
    }
}
