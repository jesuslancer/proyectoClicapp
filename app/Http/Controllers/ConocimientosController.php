<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conocimientos;

class ConocimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conocimientos = Conocimientos::all();
        return view('admin.conocimientos.index',compact('conocimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.conocimientos.create');
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

        $conocimiento = new Conocimientos();
        $conocimiento->codigo = $request->get('codigo');
        $conocimiento->nombre = $request->get('nombre');
        $conocimiento->descripcion = $request->get('descripcion');
        $conocimiento->asignatura_id = $request->get('asignatura_id');
        $conocimiento->nivel_id = $request->get('nivel_id');

        $conocimiento->save();

        return redirect('admin/conocimientos')->with('success', 'Conocimiento creado...!');
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
        $conocimiento = Conocimientos::find($id);
        return view('admin.conocimientos.edit', compact('conocimiento')); 
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

        $conocimiento = Conocimientos::find($id);
        $conocimiento->codigo = $request->get('codigo');
        $conocimiento->nombre = $request->get('nombre');
        $conocimiento->descripcion = $request->get('descripcion');
        $conocimiento->asignatura_id = $request->get('asignatura_id');
        $conocimiento->nivel_id = $request->get('nivel_id');        

        $conocimiento->save();

        return redirect('admin/conocimientos')->with('success', 'Conocimiento actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conocimiento = Conocimientos::find($id);
        $conocimiento->delete();

        return redirect('admin/conocimientos')->with('success', 'Conocimiento eliminada...!');
    }
}
