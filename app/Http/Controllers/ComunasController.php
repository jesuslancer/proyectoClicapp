<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunas;

class ComunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comunas::all();
        return view('admin.comunas.index',compact('comunas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comunas.create');
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
            'region_id'=>'required',
        ]);

        $comuna = new Comunas();
        $comuna->nombre = $request->get('nombre');
        $comuna->region_id = $request->get('region_id');

        $comuna->save();

        return redirect('admin/comunas')->with('success', 'Comuna creada...!');
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
        $comuna = Comunas::find($id);
        return view('admin.comunas.edit', compact('comuna')); 
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
            'region_id'=>'required',
        ]);

        $comuna = Comunas::find($id);
        $comuna->nombre = $request->get('nombre');
        $comuna->region_id = $request->get('region_id');

        $comuna->save();

        return redirect('admin/comunas')->with('success', 'Comuna actualizada...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comuna = Comunas::find($id);
        $comuna->delete();

        return redirect('admin/comunas')->with('success', 'Comuna eliminada...!');
    }
}
