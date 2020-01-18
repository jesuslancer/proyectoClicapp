@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Módulos </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                        @if (Auth::user()->hasRole('admin'))
                            <li><a href="{{ url('admin/usuarios') }}">Gestión de Usuarios</a></li>
                        @endif
                        <li><a href="{{ url('admin/actitudes') }}">Actitudes</a></li>
                        <li><a href="{{ url('admin/asignaturas') }}">Asignaturas</a></li>
                        <li><a href="{{ url('admin/comunas') }}">Comunas</a></li>
                        <li><a href="{{ url('admin/conocimientos') }}">Conocimientos</a></li>
                        <li><a href="{{ url('admin/cursos') }}">Cursos</a></li>
                        <li><a href="{{ url('admin/ejes') }}">Ejes</a></li>
                        <li><a href="{{ url('admin/establecimientos') }}">Establecimientos</a></li>
                        <li><a href="{{ url('admin/habilidades') }}">Habilidades</a></li>
                        <li><a href="{{ url('admin/indicadores') }}">Indicadores</a></li>
                        <li><a href="{{ url('admin/niveles') }}">Niveles</a></li>
                        <li><a href="{{ url('admin/periodos') }}">Periodos</a></li>
                        <li><a href="{{ url('admin/profesor-asignatura') }}">Profesor - Asignatura</a></li>
                        <li><a href="{{ url('admin/regiones') }}">Regiones</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
