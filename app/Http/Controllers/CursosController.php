<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cursos;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Cursos::all();
        return view('admin.cursos.index',compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cursos.create');
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
            'letra'=>'required',
            'establecimiento_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $curso = new Cursos();
        $curso->letra = $request->get('letra');
        $curso->establecimiento_id = $request->get('establecimiento_id');
        $curso->nivel_id = $request->get('nivel_id');

        $curso->save();

        return redirect('admin/cursos')->with('success', 'Curso creado...!');
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
        $curso = Cursos::find($id);
        return view('admin.cursos.edit', compact('curso')); 
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
            'letra'=>'required',
            'establecimiento_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $curso = Cursos::find($id);
        $curso->letra = $request->get('letra');
        $curso->establecimiento_id = $request->get('establecimiento_id');
        $curso->nivel_id = $request->get('nivel_id');

        $curso->save();

        return redirect('admin/cursos')->with('success', 'Curso actualizado...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Cursos::find($id);
        $curso->delete();

        return redirect('admin/cursos')->with('success', 'Curso eliminado...!');
    }
}
