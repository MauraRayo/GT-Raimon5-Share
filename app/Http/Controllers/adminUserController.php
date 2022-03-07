<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class adminUserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('admin')->all();//CHILLAR AL MIKEL
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consigue todos los usuarios bloqueados
        $usuariosBloq = User::Where('banned',1)->Where('role_id','!=',1)->get();
        //consigue todos los usuarios NO bloqueados
        $usuariosNoBloq = User::Where('banned',0)->Where('role_id','!=',1)->get();
        //consigue todos los usuarios no aceptados
        $usuariosNoAcepted = User::Where('acepted',0)->Where('role_id','!=',1)->Where('role_id','!=',2)->get();
        //consigue todos los usuarios no aceptados
        $usuariosNoAdmin = User::Where('role_id',0)->Where('role_id','!=',1)->Where('role_id','!=',2)->get();
        //se returna a la vista con los array
        return view('layouts.adminUsers.adminUsers',['usuariosBloq'=> $usuariosBloq,'usuariosNoBloq'=> $usuariosNoBloq,'usuariosNoAcepted'=> $usuariosNoAcepted,'usuariosNoAdmin'=> $usuariosNoAdmin]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        //busca el usuario con el user id
        $user=User::find(intval($data['user_id']));
        //se comprueba el tipo de accion si es banneado se cambia la bd y
        //si es aceptado empiezan los matches automaticos
        if(($data['banned']==1 || $data['banned']==0) && $data['acepted']==3 && $data['role_id']==3){
            $user->banned=$data['banned'];
        }
        elseif($data['role_id']==2 && $data['banned']==3 && $data['acepted']==3){
            $user->role_id=$data['role_id'];
        }
        elseif(($data['acepted']==1 || $data['acepted']==0) && $data['banned']==3 && $data['role_id']==3){
            $user->acepted=$data['acepted'];
            $matchController= new MatchController();
            $matchController->store(intval($data['user_id']));
        }
        $user->save();
        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
