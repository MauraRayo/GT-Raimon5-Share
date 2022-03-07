<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\WorkshopUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SoftDeletes;
    public function index()
    {
        //saca todos los talleres y la gente apuntada a estos
        $talleres = Workshop::all();
        $apuntados=[];
        foreach ($talleres as $t) {
            $ap=WorkshopUser::Where('workshop_id',$t->id)->get();
            $c=count($ap);
            $apuntados[]=$c;
        }
        return view('tabadul.talleres',['talleres'=> $talleres,'apuntados'=>$apuntados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workshop  $Workshop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workshop  $Workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $Workshop)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $Workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Workshop)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $Workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $Workshop)
    {
        $Workshop->delete();
        \Session::flash('TipoMensaje','info');
            \Session::flash('mensaje','Taller borrado correctamente');
        return \Redirect::back();
    }
}
