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

Auth::routes();

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
        Route::resource('usuarios','Auth\RegistroController');

    });
    
});


