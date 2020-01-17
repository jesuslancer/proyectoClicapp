<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personas;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class PersonasController extends Controller
{
    public function establecimientos()
    {
    	$user = User::find(Auth::user()->id);

    	$persona = Personas::find($user->id);
		
		//dd($persona);

    	$materias = DB::select('select a.id,a.nombre, n.nombre as nivel, n.id as nivel_id, c.id as curso_id, c.letra from asignaturas a
						 inner join curso_persona_asignatura cpa on cpa.asignatura_id = a.id
						 inner join personas p on p.id = cpa.persona_id
						 inner join cursos c on c.id = cpa.curso_id
						 inner join niveles n on n.id = c.nivel_id
						 where p.id = '.$persona->id .'
						 order by nivel_id, c.letra , a.nombre' );

    	return view('profesor.establecimientos')
             ->with(['persona'=>$persona, 'materias' => $materias]);
    }
}
