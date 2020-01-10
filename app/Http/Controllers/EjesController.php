<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ejes;

class EjesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejes = Ejes::all();
        return view('admin.ejes.index',compact('ejes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ejes.create');
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
            'nivel_id'=>'required',
        ]);

        $eje = new Ejes();
        $eje->nombre = $request->get('nombre');
        $eje->asignatura_id = $request->get('asignatura_id');
        $eje->nivel_id = $request->get('nivel_id');

        $eje->save();

        return redirect('admin/ejes')->with('success', 'Eje creado...!');
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
        $eje = Ejes::find($id);
        return view('admin.ejes.edit', compact('eje')); 
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
            'asignatura_id'=>'required',
            'nivel_id'=>'required',
        ]);

        $eje = Ejes::find($id);
        $eje->nombre = $request->get('nombre');
        $eje->asignatura_id = $request->get('asignatura_id');
        $eje->nivel_id = $request->get('nivel_id');        

        $eje->save();

        return redirect('admin/ejes')->with('success', 'Eje actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eje = Ejes::find($id);
        $eje->delete();

        return redirect('admin/ejes')->with('success', 'Eje eliminada...!');
    }
}
