<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habilidades;

class HabilidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habilidades = Habilidades::all();
        return view('admin.habilidades.index',compact('habilidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.habilidades.create');
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

        $habilidad = new Habilidades();
        $habilidad->codigo = $request->get('codigo');
        $habilidad->nombre = $request->get('nombre');
        $habilidad->descripcion = $request->get('descripcion');
        $habilidad->asignatura_id = $request->get('asignatura_id');
        $habilidad->nivel_id = $request->get('nivel_id');

        $habilidad->save();

        return redirect('admin/habilidades')->with('success', 'Habilidad creada...!');
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
        $habilidad = Habilidades::find($id);
        return view('admin.habilidades.edit', compact('habilidad')); 
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

        $habilidad = Habilidades::find($id);
        $habilidad->codigo = $request->get('codigo');
        $habilidad->nombre = $request->get('nombre');
        $habilidad->descripcion = $request->get('descripcion');
        $habilidad->asignatura_id = $request->get('asignatura_id');
        $habilidad->nivel_id = $request->get('nivel_id');        

        $habilidad->save();

        return redirect('admin/habilidades')->with('success', 'Habilidad actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habilidad = Habilidades::find($id);
        $habilidad->delete();

        return redirect('admin/habilidades')->with('success', 'Habilidad eliminada...!');
    }
}
