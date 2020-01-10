<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Niveles;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = Niveles::all();
        return view('admin.niveles.index',compact('niveles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.niveles.create');
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
            'asignatura_id'=>'required',
        ]);

        $nivel = new Niveles();
        $nivel->nombre = $request->get('nombre');
        $nivel->asignatura_id = $request->get('asignatura_id');

        $nivel->save();

        return redirect('admin/niveles')->with('success', 'Nivel creado...!');
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
        $nivel = Niveles::find($id);
        return view('admin.niveles.edit', compact('nivel')); 
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
            'asignatura_id'=>'required'
        ]);

        $nivel = Niveles::find($id);
        $nivel->nombre = $request->get('nombre');
        $nivel->asignatura_id = $request->get('asignatura_id');

        $nivel->save();

        return redirect('admin/niveles')->with('success', 'Nivel actualizado...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel = Niveles::find($id);
        $nivel->delete();

        return redirect('admin/niveles')->with('success', 'Nivel eliminado...!');
    }
}
