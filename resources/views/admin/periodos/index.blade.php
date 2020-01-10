@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Periodos</h1> 
            <a style="margin: 19px;" href="{{ route('periodos.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Año</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodos as $periodo)
                        <tr>
                            <td>{{$periodo->id}}</td>
                            <td>{{$periodo->anio}}</td>
                               <td>
                                <a href="{{ route('periodos.edit',$periodo->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('periodos.destroy', $periodo->id)}}" method="post">
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