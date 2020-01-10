<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProfesorAsignaturas;

class ProfesorAsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesor_asignaturas = ProfesorAsignaturas::all();
        return view('admin.profesor_asignatura.index',compact('profesor_asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profesor_asignatura.create');
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
            'profesor_id'=>'required',
            'asignatura_id'=>'required',
            'establecimiento_id'=>'required',
            'nivel_id'=>'required',
            'curso_id'=>'required',
            'periodo_id'=>'required',
        ]);

        $profesor_asignatura = new ProfesorAsignaturas();
        $profesor_asignatura->profesor_id = $request->get('profesor_id');
        $profesor_asignatura->asignatura_id = $request->get('asignatura_id');
        $profesor_asignatura->establecimiento_id = $request->get('establecimiento_id');
        $profesor_asignatura->nivel_id = $request->get('nivel_id');
        $profesor_asignatura->curso_id = $request->get('curso_id');
        $profesor_asignatura->periodo_id = $request->get('periodo_id');

        $profesor_asignatura->save();

        return redirect('admin/profesor-asignatura')->with('success', 'Asignación de Asignatura a Profesor guardada...!');
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
        $profesor_asignatura = ProfesorAsignaturas::find($id);
        return view('admin.profesor_asignatura.edit', compact('profesor_asignatura')); 
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
            'profesor_id'=>'required',
            'asignatura_id'=>'required',
            'establecimiento_id'=>'required',
            'nivel_id'=>'required',
            'curso_id'=>'required',
            'periodo_id'=>'required',
        ]);

        $profesor_asignatura = ProfesorAsignaturas::find($id);
        $profesor_asignatura->profesor_id = $request->get('profesor_id');
        $profesor_asignatura->asignatura_id = $request->get('asignatura_id');
        $profesor_asignatura->establecimiento_id = $request->get('establecimiento_id');
        $profesor_asignatura->nivel_id = $request->get('nivel_id');
        $profesor_asignatura->curso_id = $request->get('curso_id');
        $profesor_asignatura->periodo_id = $request->get('periodo_id');

        $profesor_asignatura->save();

        return redirect('admin/profesor-asignatura')->with('success', 'Asignación de actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor_asignatura = ProfesorAsignaturas::find($id);
        $profesor_asignatura->delete();

        return redirect('admin/profesor-asignatura')->with('success', 'Asignación eliminada...!');
    }
}
