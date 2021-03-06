@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Profesor Asignatura</h1> 
            <a style="margin: 19px;" href="{{ route('profesor-asignatura.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Profesor</td>
                        <td>Asignatura</td>
                        <td>Establecimiento</td>
                        <td>Nivel</td>
                        <td>Curso</td>
                        <td>Periodo</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profesor_asignaturas as $pa)
                        <tr>
                            <td>{{$pa->id}}</td>
                            <td>{{$pa->profesor_id}}</td>
                            <td>{{$pa->asignatura_id}}</td>
                            <td>{{$pa->establecimiento_id}}</td>
                            <td>{{$pa->nivel_id}}</td>
                            <td>{{$pa->curso_id}}</td>
                            <td>{{$pa->periodo_id}}</td>
                            <td>
                                <a href="{{ route('profesor-asignatura.edit',$pa->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('profesor-asignatura.destroy', $pa->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div>
    </div>
@endsection