<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicadores;

class IndicadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicadores = Indicadores::all();
        return view('admin.indicadores.index',compact('indicadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.indicadores.create');
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
            'descripcion'=>'required',
            'eje_id'=>'required',
        ]);

        $indicador = new Indicadores();
        $indicador->descripcion = $request->get('descripcion');
        $indicador->eje_id = $request->get('eje_id');

        $indicador->save();

        return redirect('admin/indicadores')->with('success', 'Indicador creada...!');
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
        $indicador = Indicadores::find($id);
        return view('admin.indicadores.edit', compact('indicador')); 
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
            'descripcion'=>'required',
            'eje_id'=>'required',
        ]);

        $indicador = Indicadores::find($id);
        $indicador->descripcion = $request->get('descripcion');
        $indicador->eje_id = $request->get('eje_id');

        $indicador->save();

        return redirect('admin/indicadores')->with('success', 'Indicador actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicador = Indicadores::find($id);
        $indicador->delete();

        return redirect('admin/indicadores')->with('success', 'Indicador eliminada...!');
    }
}
