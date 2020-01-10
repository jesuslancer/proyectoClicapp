<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodos;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodos::all();
        return view('admin.periodos.index',compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.periodos.create');
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
            'anio'=>'required',
        ]);

        $periodo = new Periodos();
        $periodo->anio = $request->get('anio');

        $periodo->save();

        return redirect('admin/periodos')->with('success', 'Periodo creado...!');
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
        $periodo = Periodos::find($id);
        return view('admin.periodos.edit', compact('periodo')); 
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
            'anio'=>'required'
        ]);

        $periodo = Periodos::find($id);
        $periodo->anio = $request->get('anio');

        $periodo->save();

        return redirect('admin/periodos')->with('success', 'Periodo actualizado...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = Periodos::find($id);
        $periodo->delete();

        return redirect('admin/periodos')->with('success', 'Periodo eliminado...!');
    }
}
