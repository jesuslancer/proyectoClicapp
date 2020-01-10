@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Niveles</h1> 
            <a style="margin: 19px;" href="{{ route('niveles.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Asignatura</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($niveles as $nivel)
                        <tr>
                            <td>{{$nivel->id}}</td>
                            <td>{{$nivel->nombre}}</td>
                            <td>{{$nivel->asignatura_id}}</td>
                            <td>
                                <a href="{{ route('niveles.edit',$nivel->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('niveles.destroy', $nivel->id)}}" method="post">
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