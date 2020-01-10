<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actitudes;

class ActitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actitudes = Actitudes::all();
        return view('admin.actitudes.index',compact('actitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actitudes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=>'required',
            'nombre'=>'required',
            'descripcion'=>'required',
            'asignatura_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $actitud = new Actitudes();
        $actitud->codigo = $request->get('codigo');
        $actitud->nombre = $request->get('nombre');
        $actitud->descripcion = $request->get('descripcion');
        $actitud->asignatura_id = $request->get('asignatura_id');
        $actitud->nivel_id = $request->get('nivel_id');

        $actitud->save();

        return redirect('admin/actitudes')->with('success', 'Actitud creada...!');
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
        $actitud = Actitudes::find($id);
        return view('admin.actitudes.edit', compact('actitud')); 
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
        $request->validate([
            'codigo'=>'required',
            'nombre'=>'required',
            'descripcion'=>'required',
            'asignatura_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $actitud = Actitudes::find($id);
        $actitud->codigo = $request->get('codigo');
        $actitud->nombre = $request->get('nombre');
        $actitud->descripcion = $request->get('descripcion');
        $actitud->asignatura_id = $request->get('asignatura_id');
        $actitud->nivel_id = $request->get('nivel_id');

        $actitud->save();

        return redirect('admin/actitudes')->with('success', 'Actitud actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actitud = Actitudes::find($id);
        $actitud->delete();

        return redirect('admin/actitudes')->with('success', 'Actitud eliminada...!');
    }
}
