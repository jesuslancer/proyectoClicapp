<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regiones;

class RegionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = Regiones::all();
        return view('admin.regiones.index',compact('regiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.regiones.create');
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
            'nombre'=>'required',
            'subtitulo'=>'required',
            'descripcion'=>'required',
            'num_horas'=>'required',
            'num_clases'=>'required',
            'asignatura_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $region = new Regiones();
        $region->nombre = $request->get('nombre');
        $region->subtitulo = $request->get('subtitulo');
        $region->descripcion = $request->get('descripcion');
        $region->num_horas = $request->get('num_horas');
        $region->num_clases = $request->get('num_clases');
        $region->asignatura_id = $request->get('asignatura_id');
        $region->nivel_id = $request->get('nivel_id');

        $region->save();

        return redirect('admin/regiones')->with('success', 'Region creada...!');
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
        $region = Regiones::find($id);
        return view('admin.regiones.edit', compact('region')); 
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
            'nombre'=>'required',
            'subtitulo'=>'required',
            'descripcion'=>'required',
            'num_horas'=>'required',
            'num_clases'=>'required',
            'asignatura_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $region = Regiones::find($id);
        $region->nombre = $request->get('nombre');
        $region->subtitulo = $request->get('subtitulo');
        $region->descripcion = $request->get('descripcion');
        $region->num_horas = $request->get('num_horas');
        $region->num_clases = $request->get('num_clases');
        $region->asignatura_id = $request->get('asignatura_id');
        $region->nivel_id = $request->get('nivel_id');

        $region->save();

        return redirect('admin/regiones')->with('success', 'Region actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Regiones::find($id);
        $region->delete();

        return redirect('admin/regiones')->with('success', 'Region eliminada...!');
    }
}
