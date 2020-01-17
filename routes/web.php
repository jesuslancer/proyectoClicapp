<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('usuarios', function () {
    return view('auth.register');
});
Auth::routes();

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/")
      ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('admin')->group(function () {
        Route::resource('profesor-asignatura', 'ProfesorAsignaturaController');
        Route::resource('profesores', 'ProfesorController');
        Route::resource('asignaturas', 'AsignaturaController');
        Route::resource('establecimientos', 'EstablecimientosController');
        Route::resource('niveles', 'NivelesController');
        Route::resource('cursos', 'CursosController');
        Route::resource('periodos', 'PeriodosController');
        Route::resource('actitudes', 'ActitudesController');
        Route::resource('comunas', 'ComunasController');
        Route::resource('conocimientos', 'ConocimientosController');
        Route::resource('ejes', 'EjesController');
        Route::resource('habilidades', 'HabilidadesController');
        Route::resource('indicadores', 'IndicadoresController');
        Route::resource('objetivos', 'ObjetivosController');
        Route::resource('regiones', 'RegionesController');
        Route::post('guardarUser','Auth\RegisterController@create');
        Route::get('/ejecucionClase/{persona_id}', 'EjecutarController@ejecucionClase')->name('ejecucionClase');
        Route::get('/establecimientos', 'PersonasController@establecimientos')->name('establecimientos');
    });
    
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
