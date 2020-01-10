@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Actitudes</h1> 
            <a style="margin: 19px;" href="{{ route('actitudes.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Codigo</td>
                        <td>Nombre</td>
                        <td>Descripcion</td>
                        <td>Asignatura</td>
                        <td>Nivel</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actitudes as $actitud)
                        <tr>
                            <td>{{$actitud->id}}</td>
                            <td>{{$actitud->codigo}}</td>
                            <td>{{$actitud->nombre}}</td>
                            <td>{{$actitud->descripcion}}</td>
                            <td>{{$actitud->asignatura_id}}</td>
                            <td>{{$actitud->nivel_id}}</td>
                            <td>
                                <a href="{{ route('actitudes.edit',$actitud->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('actitudes.destroy', $actitud->id)}}" method="post">
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