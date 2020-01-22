<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidades;
use App\Establecimientos;
use App\Personas;
use App\Cursos;
use App\Asignaturas;
use App\CursoPersonaAsignatura;
use App\Niveles;
use App\PlanificacionUnidad;
use App\PlanificacionUnidadComentario;
use App\PlanificacionGantt;
use App\PlanificacionActividad;
use App\PlanificacionEvaluacion;
use App\Objetivos;
use App\Indicadores;
use App\PlanificacionObjetivo;
use App\PlanificacionIndicador;
use App\PlanificacionHabilidad;
use App\PlanificacionConocimiento;
use App\PlanificacionActitud;
use App\PlanificacionClase;
use App\Criterio;
use App\Pregunta;
use App\EvaluacionUtp;
use App\RespuestasEvaluacionUtp;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Periodos;
use App\PlanificacionGanttComentario;
use App\PlanificacionIndicadorPropio;
use DB;

class UnidadesController extends Controller
{

    public function unidades_curso(Request $request)
    {

        //dd($request->persona_id);

    	$establecimiento = Establecimientos::find($request->establecimiento_id);
    	$asignatura = Asignaturas::find($request->asignatura_id);
    	$cursoSelect = Cursos::find($request->curso_id);
    	$niveles = Niveles::all()->pluck('nombre','id');
        $persona = Personas::find($request->persona_id);
        
    	$cursoPersonaAsignaturas = CursoPersonaAsignatura::where(['persona_id' => $request->persona_id,
    						                                      'asignatura_id' => $request->asignatura_id])
                                                        ->pluck('curso_id');
                                                        
        $cursos = array();
        foreach ($cursoPersonaAsignaturas as $curso) {
            $cursos[] = Curso::find($curso);
        }

        //Selecciona el orden de las unidades
        $orden_unidades = CursoPersonaAsignatura::where(['persona_id'    => $request->persona_id,
                                                         'asignatura_id' => $request->asignatura_id,
                                                         'curso_id'      => $request->curso_id])
                                                ->first();

        //Unidades Predeterminadas
    	$unidadesPredeterminadas = Unidad::where(['nivel_id' => $request->nivel_id,
    							                  'asignatura_id' => $request->asignatura_id,
                                                  'unidad_cero' => 'N'])
                                        ->get();

        //Unidades Genéricas
        $unidadesGenericas = PlanificacionUnidad::where(['curso_id' => $request->curso_id,
                                                         'nivel_id' => $request->nivel_id,
                                                         'asignatura_id' => $request->asignatura_id,
                                                         'profesor_id' => $request->persona_id,
                                                         'establecimiento_id' => $request->establecimiento_id,
                                                         'tipo_unidad' => 'generica'])
                                                ->get();

        //dd($unidadesGenericas);
 
    	$unidadLlena = array();
        $ganttLleno = array();
        $descripcion = array();
        $evaluaciones = [];
        $respuestas1 = [];
        $respuestas2 = [];
        $respuestas3 = [];
        $respuestas = [];
        $preguntas = Pregunta::all();

    
    	foreach ($unidadesPredeterminadas as $unidadPredeterminada) {

    		$planificacionUnidad = PlanificacionUnidad::where(['curso_id' => $request->curso_id,
                                                         'nivel_id' => $request->nivel_id,
                                                         'asignatura_id' => $request->asignatura_id,
                                                         'profesor_id' => $request->persona_id,
                                                         'establecimiento_id' => $request->establecimiento_id,
                                                         'unidad_id' => $unidadPredeterminada->id])
                                                ->first();
            
            //Si la Unidad se encuentra en la Tabla PLANIFICACION_UNIDAD                              
            if($planificacionUnidad){

                $id = $planificacionUnidad->id;

                $estatusUnidad = $planificacionUnidad->estatus;
                
                //Los Registros de la tabla PLANIFICACION_GANTT
                $objetivoClase = PlanificacionGantt::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                    ->get();

                $descripcion[$unidadPredeterminada->id] = $planificacionUnidad->descripcion_unidad;

                $clases[$unidadPredeterminada->id] = $planificacionUnidad->numero_clases;

                //Contabiliza las clases PLANIFICADAS y EJECUTADAS de la Unidad
                $clasesPlanificadas = PlanificacionClase::where(['planificacion_unidad_id' => $planificacionUnidad->id])
                                                    ->whereIn('estatus',['planificada','ejecutada'])
                                                    ->count();
                
                //Total de Clases Planificadas
                $totalClasesPlanificadas[$unidadPredeterminada->id] = $clasesPlanificadas;

                $estatus[$unidadPredeterminada->id] = $planificacionUnidad->estatus;


                //Busqueda de Evaluaciones UTP
                $periodo = Periodo::OrderBy('id','desc')->limit(1)->first();

                $evaluacion = EvaluacionUtp::where(['profesor_id' => $request->persona_id,
                                                    'planificacion_unidad_id' => $planificacionUnidad->id,
                                                    'periodo_id' => $periodo->id])
                                            ->first();
                
                //Si existe una Evaluación por parte del UTP en la tabla EVALUACION_UTP
                if ($evaluacion){

                    //Seleccionamos las Respuestas de la Evaluación
                    $respuestas[$unidadPredeterminada->id] = RespuestasEvaluacionUtp::where('evaluacion_utp_id',$evaluacion->id)
                                                                    ->get();

                    //Seleccionamos el campo APROBACION de la tabla EVALUACION_UTP
                    $evaluaciones[$unidadPredeterminada->id] = $evaluacion->aprobacion;

                    //dd($evaluaciones[$unidadPredeterminada->id]);

                    $respuestas1[$unidadPredeterminada->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 1');

                    $respuestas2[$unidadPredeterminada->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 2');

                    $respuestas3[$unidadPredeterminada->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 3');

                }else{//Si NO existe una Evaluación por parte del UTP en la tabla EVALUACION_UTP

                    $evaluaciones[$unidadPredeterminada->id] = '';

                }

            }else{ //Si la Unidad NO se encuentra en la Tabla PLANIFICACION_UNIDAD
                $id = 0;
                $objetivoClase = '';
                $descripcion[$unidadPredeterminada->id] = '';
                $clases[$unidadPredeterminada->id] = '';
                $totalClasesPlanificadas[$unidadPredeterminada->id] = '';
                $evaluaciones[$unidadPredeterminada->id] = '';
                $estatus[$unidadPredeterminada->id] = '';
            }

            //Si la variable $objetivoClase es diferente de vacío
            if($objetivoClase !='' ){

                $ganttLleno[$unidadPredeterminada->id] = $id;

            }else{//Si la variable $objetivoClase es vacía

                $ganttLleno[$unidadPredeterminada->id] = 0;

            }

            //Se le asigna a la variable $unidadLlena el valor de la variable $id
    		$unidadLlena[$unidadPredeterminada->id] = $id;
 
    	}//Fin foreach $unidadesPredeterminadas


        //dd($unidadLlena);
        $unidadLlenaG = array();
        $ganttLlenoG = array();
        $descripcionG = array();
        $evaluacionesG = [];
        $respuestas1G = [];
        $respuestas2G = [];
        $respuestas3G = [];
        $respuestasG = [];
        $preguntasG = Pregunta::all();
        $totalCartaGantt = 0;

    	foreach ($unidadesGenericas as $unidadGenerica) {

    		$planificacionUnidad = PlanificacionUnidad::where(['curso_id' => $request->curso_id,
                                                         'nivel_id' => $request->nivel_id,
                                                         'asignatura_id' => $request->asignatura_id,
                                                         'profesor_id' => $request->persona_id,
                                                         'establecimiento_id' => $request->establecimiento_id,
                                                         'tipo_unidad' => 'generica'])
                                                    ->first();
            //dd($planificacionUnidad);

            //Si la Unidad se encuentra en la Tabla PLANIFICACION_UNIDAD                              
            if($planificacionUnidad){

                $id = $planificacionUnidad->id;
                
                //Los Registros de la tabla PLANIFICACION_GANTT
                $objetivoClase = PlanificacionGantt::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                    ->get();

                $descripcionG[$unidadGenerica->id] = $planificacionUnidad->descripcion_unidad;

                $clasesG[$unidadGenerica->id] = $planificacionUnidad->numero_clases;

                //Contabiliza las clases PLANIFICADAS y EJECUTADAS de la Unidad
                $clasesPlanificadas = PlanificacionClase::where(['planificacion_unidad_id' => $planificacionUnidad->id])
                                                    ->whereIn('estatus',['planificada','ejecutada'])
                                                    ->count();
                
                //Total de Clases Planificadas
                $totalClasesPlanificadasG[$unidadGenerica->id] = $clasesPlanificadas;

                $totalCartaGantt = PlanificacionGantt::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                    ->count();

                //dd($totalCartaGantt);

                //Busqueda de Evaluaciones UTP
                $periodo = Periodo::OrderBy('id','desc')->limit(1)->first();

                //EVALUACIONES
                $evaluacion = EvaluacionUtp::where(['profesor_id' => $request->persona_id,
                                                    'planificacion_unidad_id' => $planificacionUnidad->id,
                                                    'periodo_id' => $periodo->id])
                                            ->first();

                //Si existe una Evaluación por parte del UTP en la tabla EVALUACION_UTP
                if ($evaluacion){

                    //Seleccionamos las Respuestas de la Evaluación
                    $respuestasG[$unidadGenerica->id] = RespuestasEvaluacionUtp::where('evaluacion_utp_id',$evaluacion->id)
                                                                    ->get();

                    //Seleccionamos el campo APROBACION de la tabla EVALUACION_UTP
                    $evaluacionesG[$unidadGenerica->id] = $evaluacion->aprobacion;

                    $respuestas1G[$unidadGenerica->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 1');

                    $respuestas2G[$unidadGenerica->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 2');

                    $respuestas3G[$unidadGenerica->id] = DB::select('select p.pregunta, rp.respuesta, rp.comentario from respuestas_evaluacion_utp rp
                        inner join preguntas p on p.id = rp.pregunta_id
                        where rp.evaluacion_utp_id = '.$evaluacion->id.'
                        and criterio_id = 3');

                }else{//Si NO existe una Evaluación por parte del UTP en la tabla EVALUACION_UTP

                    $evaluacionesG[$unidadGenerica->id] = '';

                }

            }else{ //Si la Unidad NO se encuentra en la Tabla PLANIFICACION_UNIDAD
                $id = 0;
                $objetivoClase = '';
                $descripcionG[$unidadGenerica->id] = '';
                $clasesG[$unidadGenerica->id] = '';
                $totalClasesPlanificadasG[$unidadGenerica->id] = '';
                $totalCartaGantt = 0;
                $evaluacionesG[$unidadGenerica->id] = '';
            }

            

            //Si la variable $objetivoClase es diferente de vacío
            if($objetivoClase !='' ){

                $ganttLlenoG[$unidadGenerica->id] = $id;


            }else{//Si la variable $objetivoClase es vacía

                $ganttLlenoG[$unidadGenerica->id] = 0;

            }

            //Se le asigna a la variable $unidadLlenaG el valor de la variable $id
    		$unidadLlenaG[$unidadGenerica->id] = $id;

    	}//Fin foreach $unidadesGenericas


        //dd($estatusUnidad);

    	return view('profesor.unidades')->with(['establecimiento' =>$establecimiento,
                                            'asignatura' => $asignatura,
                                            'cursos' => $cursos,
                                            'niveles' => $niveles,
                                            'cursoSelect' => $cursoSelect,
                                            'persona' => $persona,
                                            'unidadesPredeterminadas' => $unidadesPredeterminadas,
                                            'unidadesGenericas' => $unidadesGenericas,
                                            'unidadLlena' => $unidadLlena,
                                            'unidadLlenaG' => $unidadLlenaG,
                                            'ganttLleno' => $ganttLleno,
                                            'ganttLlenoG' => $ganttLlenoG,
                                            //'unidad_cero'       => $unidad_cero,
                                            //'unidad_cero_exist' => $unidad_cero_exist,
                                            'descripcion' => $descripcion,
                                            'evaluaciones' => $evaluaciones,
                                            'evaluacionesG' => $evaluacionesG,
                                            'respuestas1' => $respuestas1,
                                            'respuestas1G' => $respuestas1G,
                                            'respuestas2' => $respuestas2,
                                            'respuestas2G' => $respuestas2G,
                                            'respuestas3' => $respuestas3,
                                            'respuestas3G' => $respuestas3G,
                                            'respuestas' => $respuestas,
                                            'respuestasG' => $respuestasG,
                                            'preguntas' => $preguntas,
                                            'preguntasG' => $preguntasG,
                                            'clases'=> $clases,
                                            'estatus'=> $estatus,
                                            'totalCartaGantt'=> $totalCartaGantt,
                                            //'clasesG' => $clasesG,
                                            'clasesPlanificadas' => $totalClasesPlanificadas,
                                            //'clasesPlanificadasG' => $totalClasesPlanificadasG,
                                            'estatusUnidad' => $estatusUnidad,
                                            'orden_unidades'    => $orden_unidades->orden_unidades]);
    }



    public function showUnidad(Request $request)
    {

        //dd(auth()->user()->id);
        //dd($request->planificacion_id);

        $planificacionExist = PlanificacionUnidad::find($request->planificacion_id);

        $establecimiento    = Establecimiento::find($request->establecimiento_id);

        //dd($establecimiento);

        $asignatura         = Asignatura::find($planificacionExist->asignatura_id);
        $cursoSelect        = Curso::find($planificacionExist->curso_id);
        $niveles            = Nivel::all()->pluck('nombre','id');
        $persona            = Persona::find($planificacionExist->profesor_id);
        $unidad             = Unidad::find($planificacionExist->unidad_id);
        $utp_id             = auth()->user()->id;

            //dd($unidad);
            //dd($unidad->objetivos);

        //***** DEVUELVE EL RESULTADO DE LA PLANIFICACION SI EXISTE */
        $planificacionUnidad = PlanificacionUnidad::find($request->unidad_id);


        if($unidad != NULL){
      
            $nivel = $unidad->nivel_id;


            $unidades = Unidad::where([
                                    'nivel_id'      => $nivel,
                                    'asignatura_id' => $unidad->asignatura_id,
                                    'unidad_cero'   => 'N'
                                ])->pluck('nombre','id');


            //***** LLAMA AL METODO HABILIDADES DEL MODELO UNIDAD - SELECCIONA TODAS LAS HABILIDADES QUE "PERTENECEN A" UNA UNIDAD  */
            //***** TRAE UN ARREGLO CON TODOS LOS CAMPOS DE LAS HABILIDADES QUE PERTENECEN A ESA UNIDAD */
            $habilidades = $unidad->habilidades;
            //dd($habilidades);

            //***** LLAMA AL METODO CONOCIMIENTOS DEL MODELO UNIDAD - SELECCIONA TODAS L0S CONOCIMIENTOS QUE "PERTENECEN A" UNA UNIDAD  */
            //***** TRAE UN ARREGLO CON TODOS LOS CAMPOS DE LAS CONOCIMIENTOS QUE PERTENECEN A ESA UNIDAD */
            $conocimientos = $unidad->conocimientos;
            //dd($conocimientos);

            //***** LLAMA AL METODO ACTITUDES DEL MODELO UNIDAD - SELECCIONA TODAS LAS ACTITUDES QUE "PERTENECEN A" UNA UNIDAD  */
            //***** TRAE UN ARREGLO CON TODOS LOS CAMPOS DE LAS ACTITUDES QUE PERTENECEN A ESA UNIDAD */
            $actitudes = $unidad->actitudes;
            //dd($actitudes);

            $actividades = PlanificacionActividad::where([
                                    'unidad_id'         => $planificacionExist->unidad_id,
                                    'profesor_id'       => $planificacionExist->profesor_id,
                                    'establecimiento_id' => $request->establecimiento_id,
                            ])->get();

            $evaluaciones = PlanificacionEvaluacion::where([
                                    'unidad_id'         => $planificacionExist->unidad_id,
                                    'profesor_id'       => $planificacionExist->profesor_id,
                                    'establecimiento_id' => $request->establecimiento_id,
                            ])->get();

            //***** SI LAS VARIABLES $actividades, $evaluaciones, $habilidades SON VACIAS LAS DECLARA VACIAS*/
            if ($actividades->isEmpty()){
                $actividades = '';
            }
            if ($evaluaciones->isEmpty()){
                $evaluaciones = '';
            }
            if ($habilidades->isEmpty()){
                $habilidades = '';
            }
            if ($conocimientos->isEmpty()){
                $conocimientos = '';
            }
            if ($actitudes->isEmpty()){
                $actitudes = '';
            }


            $objetivosEje = array();
            $objetivosSave = array();

            $primerObj = $unidad->objetivos[0]->id;

            $objetivoIni    = Objetivo::find($primerObj);
            $indicadores    = Indicador::where([
                            'objetivo_id' => $primerObj,
                            'unidad_id' => $planificacionExist->unidad_id,
                        ])->get();


            $totalIndicador = 0;


            foreach ($unidad->objetivos as $obje) {
                $objetivosEje[$obje->id] = $obje->codigo." - ".$obje->descripcion;
                $totalIndicador = Indicador::where([
                            'objetivo_id' => $obje->id,
                            'unidad_id'   => $planificacionExist->unidad_id,
                        ])->count() + $totalIndicador;

                $objetivosSave[]  =  $obje->id;
            }



            $planificacion_objetivos = PlanificacionObjetivo::where(
                'planificacion_unidad_id',$planificacionExist->id)->pluck('objetivo_id');
            $planificacion_indicadores = PlanificacionIndicador::where(
                'planificacion_unidad_id',$planificacionExist->id)->pluck('indicador_id');
            $planificacion_habilidades = PlanificacionHabilidad::where(
                'planificacion_unidad_id',$planificacionExist->id)->pluck('habilidad_id');
            $planificacion_conocimientos = PlanificacionConocimiento::where(
                'planificacion_unidad_id',$planificacionExist->id)->pluck('conocimiento_id');
            $planificacion_actitudes = PlanificacionActitud::where(
                'planificacion_unidad_id',$planificacionExist->id)->pluck('actitud_id');
            $plan_id = $planificacionExist->id;


            if ($planificacion_objetivos!=''){
                $objetivosPlan = array();
                foreach ($planificacion_objetivos as $plan_obj) {
                        $obj = Objetivo::find($plan_obj);
                        $objetivosPlan[$obj->id] = $obj->id." - ".$obj->codigo." - ".$obj->descripcion;
                    }

                $objetivosEje = $objetivosEje + $objetivosPlan;
            }

                    //***** DEVUELVE EL RESULTADO DE LOS COMENTARIOS SI EXISTEN */
        $comentariosUnidad = PlanificacionUnidadComentario::where(['planificacion_unidad_id' => $planificacionExist->id])->get();

        //dd($comentariosUnidad);


            return view('utp.plan-unidad')
            ->with(['establecimiento'   =>$establecimiento,
                'asignatura'        => $asignatura,
                'niveles'           => $niveles,
                'cursoSelect'       => $cursoSelect,
                'persona'           => $persona,
                'utp_id'            => $utp_id,
                'unidad'            => $unidad,
                'objetivosEje'      => $objetivosEje,
                'indicadores'       => $indicadores,
                'habilidades'       => $habilidades,
                'conocimientos'     => $conocimientos,
                'actitudes'         => $actitudes,
                'objetivo'          => $objetivoIni,
                'unidades'          => $unidades,
                'planificacionExist'=> $planificacionExist,
                'planificacion_objetivos'=> $planificacion_objetivos,
                'planificacion_indicadores'=> $planificacion_indicadores,
                'planificacion_conocimientos'=> $planificacion_conocimientos,
                'planificacion_habilidades'=> $planificacion_habilidades,
                'planificacion_actitudes'=> $planificacion_actitudes,
                'actividades'           => $actividades,
                'evaluaciones'          => $evaluaciones,
                'planificacion'         => $plan_id,
                'totalIndicador'        => $totalIndicador,
                'establecimiento_id'        => $establecimiento->id,
                'comentariosUnidad'    => $comentariosUnidad
                ]);
        }else{

             //***** DEVUELVE EL RESULTADO DE LA PLANIFICACION SI EXISTE */
            $planificacionUnidad = PlanificacionUnidad::find($request->planificacion_id);

            $unidad = PlanificacionUnidad::find($request->planificacion_id);

            $unidadesPredeterminadas = Unidad::where(['nivel_id' => $planificacionUnidad->nivel_id,
                                                  'asignatura_id' => $planificacionUnidad->asignatura_id,
                                                  'unidad_cero'   => 'N'])
                                        ->pluck('nombre','id');

            //dd($unidadesPredeterminadas);

            //***** DEVUELVE EL RESULTADO DE LOS COMENTARIOS SI EXISTEN */
            $comentariosUnidad = PlanificacionUnidadComentario::where(['planificacion_unidad_id' => $planificacionUnidad->id])->get();


            //dd($comentariosUnidad);
            
            $planificacionHabilidades = array();
            $planificacionConocimientos = array();
            $planificacionActitudes = array();

            $planificacionObjetivos = PlanificacionObjetivo::where('planificacion_unidad_id',$planificacionUnidad->id)->pluck('objetivo_id');
            $planificacionHabilidades = PlanificacionHabilidad::where('planificacion_unidad_id',$planificacionUnidad->id)->pluck('habilidad_id');
            $planificacionConocimientos = PlanificacionConocimiento::where('planificacion_unidad_id',$planificacionUnidad->id)->pluck('conocimiento_id');
            $planificacionActitudes = PlanificacionActitud::where('planificacion_unidad_id',$planificacionUnidad->id)->pluck('actitud_id');


            $cantidadObjetivos = PlanificacionObjetivo::where('planificacion_unidad_id',$planificacionUnidad->id)->count();
            $cantidadIndicadores = PlanificacionIndicador::where('planificacion_unidad_id',$planificacionUnidad->id)->count();
            $cantidadHabilidades = PlanificacionHabilidad::where('planificacion_unidad_id',$planificacionUnidad->id)->count();
            $cantidadConocimientos = PlanificacionConocimiento::where('planificacion_unidad_id',$planificacionUnidad->id)->count();
            $cantidadActitudes = PlanificacionActitud::where('planificacion_unidad_id',$planificacionUnidad->id)->count();

            //dd($cantidadIndicadores);

            $primerObjetivo = PlanificacionObjetivo::where('planificacion_unidad_id',$planificacionUnidad->id)->first();

            if ($primerObjetivo){

                $objetivoInicial = Objetivo::find($primerObjetivo->objetivo_id);

                //Indicadores del Primer Objetivo registrado para la Unidad
                $indicadores = Indicador::where(['objetivo_id' => $primerObjetivo->objetivo_id,
                                                'unidad_id' => $primerObjetivo->unidad_id])
                                        ->get();
                //dd($indicadores);

                // DEVUELVE UN ARREGLO CON LOS INDICADORES PROPIOS DEL PRIMER OBJETIVO REGISTRADO PARA LA UNIDAD
                $indicadoresPropios = PlanificacionIndicadorPropio::where(['planificacion_unidad_id' => $planificacionUnidad->id,
                                                                    'profesor_id'   => $request->persona_id,
                                                                    'objetivo_id' => $primerObjetivo->objetivo_id])->get(); // TODO: VERIFICAR GUARDADO DEL INDICADOR Y EL OBJETIVO

                //dd($indicadoresPropios);
            
                $planificacion_objetivos = PlanificacionObjetivo::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                    ->pluck('objetivo_id');

                $planificacion_indicadores = PlanificacionIndicador::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                    ->pluck('indicador_id');
            
                $planificacion_objetivos_unidad = PlanificacionObjetivo::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                        ->get();

                $planificacion_habilidades = PlanificacionHabilidad::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                    ->pluck('habilidad_id');

                $planificacion_conocimientos = PlanificacionConocimiento::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                        ->pluck('conocimiento_id');

                $planificacion_actitudes = PlanificacionActitud::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                        ->pluck('actitud_id');
                //dd($planificacion_conocimientos);

                $objetivosEjeUnidad = array();

                if ($planificacionObjetivos!=''){
                    $objetivosPlan = array();
                        foreach ($planificacionObjetivos as $planificacionObjetivo) {
                            $objetivo = Objetivo::find($planificacionObjetivo);                   
                            $objetivosPlan[$objetivo->id] = $objetivo->codigo." - ".$objetivo->descripcion;
                        }
                    $objetivosRegistrados = $objetivosPlan;
                }

                foreach ($planificacion_objetivos_unidad as $obj_uni) {
                    $objetivosEjeUnidad[$obj_uni->objetivo_id] = $obj_uni->unidad_id;
                }

            
                $habilidad = '';
                if ($planificacionHabilidades!=''){
                    $habilidadesPlan = array();
                        foreach ($planificacionHabilidades as $planificacionHabilidad) {
                            $habilidad = Habilidad::find($planificacionHabilidad);                   
                            $habilidadesPlan[$habilidad->id] = $habilidad->descripcion;
                        }
                    $habilidadesRegistradas = $habilidadesPlan;
                }

                $conocimiento = '';
                if ($planificacionConocimientos!=''){
                    $conocimientosPlan = array();
                        foreach ($planificacionConocimientos as $planificacionConocimiento) {
                            $conocimiento = Conocimiento::find($planificacionConocimiento);                   
                            $conocimientosPlan[$conocimiento->id] = $conocimiento->descripcion;
                        }
                    $conocimientosRegistrados = $conocimientosPlan;
                }

                $actitud = '';
                if ($planificacionActitudes!=''){
                    $actitudesPlan = array();
                        foreach ($planificacionActitudes as $planificacionActitud) {
                            $actitud = Actitud::find($planificacionActitud);                   
                            $actitudesPlan[$actitud->id] = $actitud->descripcion;
                        }
                    $actitudesRegistradas = $actitudesPlan;
                }

            }else{

                    
                $objetivoInicial = '';
                $indicadores = '';
                $indicadoresPropios = '';
                $objetivosRegistrados = '';
                $objetivosEjeUnidad = '';
                $planificacion_objetivos = '';
                $planificacion_indicadores = '';


                $planificacion_habilidades = array();
                // DEVUELVE UN ARREGLO CON LOS ID DE LAS HABILIDADES QUE EXISTEN EN LA TABLA PLANIFICACION_HABILIDADES QUE PERTENECEN A LA PLANIFICACION
                $planificacion_habilidades = PlanificacionHabilidad::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                            ->pluck('habilidad_id');


                if ($planificacion_habilidades->isEmpty()) {
                    $planificacionHabilidades = '';
                    $habilidadesRegistradas = '';
                }else{
                    $habilidadesPlan = array();
                    foreach ($planificacionHabilidades as $planificacionHabilidad) {
                        $habilidad = Habilidad::find($planificacionHabilidad);                   
                        $habilidadesPlan[$habilidad->id] = $habilidad->descripcion;
                    }
                    $habilidadesRegistradas = $habilidadesPlan;
                }
            
                $planificacion_conocimientos = array();
                // DEVUELVE UN ARREGLO CON LOS ID DE LAS HABILIDADES QUE EXISTEN EN LA TABLA PLANIFICACION_HABILIDADES QUE PERTENECEN A LA PLANIFICACION
                $planificacion_conocimientos = PlanificacionConocimiento::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                    ->pluck('conocimiento_id');

                //dd($planificacion_conocimientos);
                if ($planificacion_conocimientos->isEmpty()) {
                    $planificacion_conocimientos = '';
                    $conocimientosRegistrados = '';
                }else{
                    //$conocimiento = '';
                    $conocimientosPlan = array();
                    foreach ($planificacionConocimientos as $planificacionConocimiento) {
                        $conocimiento = Conocimiento::find($planificacionConocimiento);                   
                        $conocimientosPlan[$conocimiento->id] = $conocimiento->descripcion;
                    }
                    $conocimientosRegistrados = $conocimientosPlan;
                }

                //dd($conocimientosRegistrados);

                $planificacion_actitudes = array();
                // DEVUELVE UN ARREGLO CON LOS ID DE LAS HABILIDADES QUE EXISTEN EN LA TABLA PLANIFICACION_HABILIDADES QUE PERTENECEN A LA PLANIFICACION
                $planificacion_actitudes = PlanificacionActitud::where('planificacion_unidad_id',$planificacionUnidad->id)
                                                                ->pluck('actitud_id');
        
                //dd($planificacion_conocimientos);
                if ($planificacion_actitudes->isEmpty()) {
                    $planificacion_actitudes = '';
                    $actitudesRegistradas = '';
                }else{
                    //$conocimiento = '';
                    $actitudesPlan = array();
                    foreach ($planificacionActitudes as $planificacionActitud) {
                        $actitud = Actitud::find($planificacionActitud);                   
                        $actitudesPlan[$actitud->id] = $actitud->descripcion;
                    }
                    $actitudesRegistradas = $actitudesPlan;
                }
                //dd($actitudesRegistradas);


            }

                //***** SELECCIONA LAS EVALUACIONES DE LA PLANIFICACION */
                $evaluaciones = PlanificacionEvaluacion::where(['planificacion_unidad_id' => $planificacionUnidad->id,
                                                        'profesor_id' => $request->persona_id,
                                                        'establecimiento_id' => $request->establecimiento_id])
                                                    ->get();

                if ($evaluaciones->isEmpty()){
                $evaluaciones = '';
                }

                //***** SELECCIONA LAS ACTIVIDADES DE LA PLANIFICACION */
                $actividades = PlanificacionActividad::where(['planificacion_unidad_id' => $planificacionUnidad->id,
                    'profesor_id' => $request->persona_id,
                    'establecimiento_id' => $request->establecimiento_id])
                ->get();

                //***** SI LAS VARIABLES $actividades, $evaluaciones, $habilidades SON VACIAS LAS DECLARA VACIAS*/
                if ($actividades->isEmpty()){
                $actividades = '';
                }

            //dd('generica');
            return view('utp.plan-unidad-gen')->with(['establecimiento' =>$establecimiento,
                                                          'asignatura' => $asignatura,
                                                          'niveles' => $niveles,
                                                          'cursoSelect'  => $cursoSelect,
                                                          'persona' => $persona,
                                                          'utp_id' => $utp_id,
                                                          'unidad' => $unidad,
                                                          'objetivosEje' => $objetivosRegistrados,
                                                          'objetivo' => $objetivoInicial,
                                                          'indicadores' => $indicadores,
                                                          'indicadoresPropios' => $indicadoresPropios,
                                                          'evaluaciones' => $evaluaciones,
                                                          'actividades' => $actividades,
                                                          'objetivosEjeUnidad' => $objetivosEjeUnidad,
                                                          'planificacion_objetivos'=> $planificacion_objetivos,
                                                          'planificacion_indicadores'=> $planificacion_indicadores,
                                                          'planificacion_habilidades'=> $planificacion_habilidades,
                                                          'habilidades'=> $habilidadesRegistradas,
                                                          'conocimientos'=> $conocimientosRegistrados,
                                                          'planificacion_conocimientos'=> $planificacion_conocimientos,
                                                          'actitudes'=> $actitudesRegistradas,
                                                          'planificacion_actitudes'=> $planificacion_actitudes,
                                                          'cantidadObjetivos'=> $cantidadObjetivos,
                                                          'cantidadIndicadores'=> $cantidadIndicadores,
                                                          'cantidadHabilidades'=> $cantidadHabilidades,
                                                          'cantidadConocimientos'=> $cantidadConocimientos,
                                                          'cantidadActitudes'=> $cantidadActitudes,
                                                          'comentariosUnidad'    => $comentariosUnidad,
                                                          'establecimiento_id'        => $establecimiento->id,
                                                 ]);


        }

            
        
    }

    public function showGantt(Request $request){

        $planificacion = PlanificacionUnidad::find($request->planificacion_id);

        $cursoSelect = Curso::find($planificacion->curso_id);
        $establecimiento = Establecimiento::find($cursoSelect->establecimiento_id);
        $asignatura = Asignatura::find($planificacion->asignatura_id);

        $niveles = Nivel::all()->pluck('nombre','id');
        $persona = Persona::find($planificacion->profesor_id);
        $profesor_id = $persona->id;
        $unidad = Unidad::find($planificacion->unidad_id);
        $utp_id = auth()->user()->id;


        //***** DEVUELVE EL RESULTADO DE LOS COMENTARIOS SI EXISTEN */
        $comentariosGantt = PlanificacionGanttComentario::where(['planificacion_unidad_id' => $planificacion->id,
                                                                 'profesor_id' => $planificacion->profesor_id])
                                                        ->get();


        if($unidad != NULL){

            return view('utp.gantt-utp')
            ->with([
                    'planificacion' => $planificacion,
                    'establecimiento' =>$establecimiento,
                    'asignatura' => $asignatura,
                    'niveles' => $niveles,
                    'cursoSelect' => $cursoSelect,
                    'persona' => $persona,
                    'profesor_id' => $profesor_id,
                    'utp_id' => $utp_id,
                    'unidad' => $unidad,
                    'establecimiento_id' => $request->establecimiento_id,
                    'comentariosGantt'  => $comentariosGantt
                ]);

        }else{

            $unidad = Unidad::find($planificacion->id);

            return view('utp.gantt-utp-gen')
            ->with([
                    'planificacion'     => $planificacion,
                    'clase_id'          => $request->clase_id,
                    'establecimiento'   => $establecimiento,
                    'asignatura'        => $asignatura,
                    'niveles'           => $niveles,
                    'cursoSelect'       => $cursoSelect,
                    'persona'           => $persona,
                    'profesor_id' => $profesor_id,
                    'utp_id' => $utp_id,
                    'unidad'            => $unidad,
                    'establecimiento_id'        => $establecimiento->id,
                    'comentariosGantt'  => $comentariosGantt
                ]);
        }
    }


    public function evaluar(Request $request){

        $planificacion = PlanificacionUnidad::find($request->unidad_id);

        //dd($planificacion);

        $persona    = Persona::find($request->profesor_id);
        $curso      = Curso::find($request->curso_id);
       // $unidad     = Unidad::find($request->unidad_id);
        $asignatura = Asignatura::find($planificacion->asignatura_id,['nombre'] );
        $nivel      = Nivel::find($planificacion->nivel_id,['nombre']);

        $preguntas1  = Pregunta::where('criterio_id',1)->get();
        $preguntas2  = Pregunta::where('criterio_id',2)->get();
        $preguntas3  = Pregunta::where('criterio_id',3)->get();

        $user   = User::find(Auth::user()->id);
        $utp    = Persona::find($user->persona_id);
        $periodo = Periodo::OrderBy('id','desc')->limit(1)->first();

        $evaluacion = EvaluacionUtp::where(['utp_id' => $utp->id,
                                            'profesor_id' => $request->profesor_id,
                                            'planificacion_unidad_id' => $request->unidad_id,
                                            'periodo_id' => $periodo->id])
                                    ->first();

        $array_resp = [];
        $array_coment = [];

        if ($evaluacion){

            $respuestas = RespuestasEvaluacionUtp::where('evaluacion_utp_id',$evaluacion->id)
                                                    ->get();

            foreach ($respuestas as $resp) {

                $array_resp[$resp->pregunta_id] = $resp->respuesta;
                $array_coment[$resp->pregunta_id] = $resp->comentario;

            }
        }

        $preguntas = Pregunta::all()->count();

        return view('utp.evaluacion')
            ->with([
                    'persona'                       => $persona,
                    'preguntas1'                    => $preguntas1,
                    'preguntas2'                    => $preguntas2,
                    'preguntas3'                    => $preguntas3,
                    'curso'                         => $curso,
                    'asignatura'                    => $asignatura,
                    'nivel'                         => $nivel,
                    'establecimiento_id'            => $request->establecimiento_id,
                    'unidad_id'                     => $request->unidad_id,
                    'evaluacion'                    => $evaluacion,
                    'respuestas'                    => $array_resp,
                    'comentarios'                   => $array_coment,
                    'total_preguntas'               => $preguntas,

                ]);
    }

    public function saveEvaluacion(Request $request){

        //dd($request);
        $user   = User::find(Auth::user()->id);
        $utp    = Persona::find($user->persona_id);
        $periodo = Periodo::OrderBy('id','desc')->limit(1)->first();

        $evaluacion = EvaluacionUtp::where([
                        'utp_id'        => $utp->id,
                        'profesor_id'   => $request->profesor_id,
                        'planificacion_unidad_id'     => $request->unidad_id,
                        'periodo_id'    => $periodo->id
                    ])->first();

        $preguntas = Pregunta::all()->count();
        //dd($evaluacion);
        if($evaluacion){

            $delResp = RespuestasEvaluacionUtp::where('evaluacion_utp_id',$evaluacion->id)->delete();
            for($i=1; $i <=$preguntas; $i++ ){

                $evaluacion->aprobacion = $request->aprobacion;
                $evaluacion->save();

                $preg = "pregunta".$i;
                $come = "comentario".$i;
                    if ($request->$preg !==null){
                        $resp = New RespuestasEvaluacionUtp();
                        $resp->evaluacion_utp_id = $evaluacion->id;
                        $resp->pregunta_id = $i;
                        $resp->respuesta = $request->$preg;
                        $resp->comentario = $request->$come;
                        $resp->save();
                    }
                }
        }else{

            DB::transaction(function () use ($utp,$request,$periodo,$preguntas) {

                $eva = New EvaluacionUtp();
                $eva->utp_id        = $utp->id;
                $eva->profesor_id   = $request->profesor_id;
                $eva->planificacion_unidad_id     = $request->unidad_id;
                $eva->periodo_id    = $periodo->id;
                $eva->aprobacion    = $request->aprobacion;
                $eva->save();

                for($i=1; $i <=$preguntas; $i++ ){

                $preg = "pregunta".$i;
                $come = "comentario".$i;

                    if ($request->$preg !==null){
                        $resp = New RespuestasEvaluacionUtp();
                        $resp->planificacion_unidad_id = $request->unidad_id;
                        $resp->evaluacion_utp_id = $eva->id;
                        $resp->pregunta_id = $i;
                        $resp->respuesta = $request->$preg;
                        $resp->comentario = $request->$come;
                        $resp->save();
                    }
                }
            });

        }


        return redirect()->route('revision', [
                                'profesor_id'   => $request->profesor_id,
                                'establecimiento_id' => $request->establecimiento_id
                            ]);
    }


    public function ordenarUnidad(Request $request){
        $cpa = CursoPersonaAsignatura::where([
                    'curso_id'      => $request->curso_id,
                    'asignatura_id' => $request->asignatura_id,
                    'persona_id'    => $request->persona_id,
                ])->first();

        $cpa->orden_unidades = $request->orden;
        $cpa->save();

        $response = $request->orden;

        return response()->json([
            'response' => $response,
        ]);
    }

}
