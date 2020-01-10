<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignaturas;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = Asignaturas::all();
        return view('admin.asignatura.index',compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asignatura.create');
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
        ]);

        $asignatura = new Asignaturas();
        $asignatura->nombre = $request->get('nombre');

        $asignatura->save();

        return redirect('admin/asignaturas')->with('success', 'Asignatura creada...!');
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
        $asignatura = Asignaturas::find($id);
        return view('admin.asignatura.edit', compact('asignatura')); 
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
            'nombre'=>'required'
        ]);

        $asignatura = Asignaturas::find($id);
        $asignatura->nombre = $request->get('nombre');

        $asignatura->save();

        return redirect('admin/asignaturas')->with('success', 'Asignatura actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignatura = Asignaturas::find($id);
        $asignatura->delete();

        return redirect('admin/asignaturas')->with('success', 'Asignatura eliminada...!');
    }
}
