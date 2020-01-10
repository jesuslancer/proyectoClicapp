<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Establecimientos;

class EstablecimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establecimientos = Establecimientos::all();
        return view('admin.establecimientos.index',compact('establecimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.establecimientos.create');
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
            'rbd'=>'required',
            'dv'=>'required',
            'nivel_id'=>'required',
        ]);

        $establecimiento = new Establecimientos();
        $establecimiento->nombre = $request->get('nombre');
        $establecimiento->rbd = $request->get('rbd');
        $establecimiento->dv = $request->get('dv');
        $establecimiento->nivel_id = $request->get('nivel_id');

        $establecimiento->save();

        return redirect('admin/establecimientos')->with('success', 'Establecimiento creado...!');
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
        $establecimiento = Establecimientos::find($id);
        return view('admin.establecimientos.edit', compact('establecimiento')); 
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
            'rbd'=>'required',
            'dv'=>'required',
            'nivel_id'=>'required',
        ]);

        $establecimiento = Establecimientos::find($id);
        $establecimiento->nombre = $request->get('nombre');
        $establecimiento->rbd = $request->get('rbd');
        $establecimiento->dv = $request->get('dv');
        $establecimiento->nivel_id = $request->get('nivel_id');

        $establecimiento->save();

        return redirect('admin/establecimientos')->with('success', 'Establecimiento actualizado...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establecimiento = Establecimientos::find($id);
        $establecimiento->delete();

        return redirect('admin/establecimientos')->with('success', 'Establecimiento eliminado...!');
    }
}
