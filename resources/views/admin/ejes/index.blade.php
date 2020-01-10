@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Ejes</h1> 
            <a style="margin: 19px;" href="{{ route('ejes.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Asignatura</td>
                        <td>Nivel</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ejes as $eje)
                        <tr>
                            <td>{{$eje->id}}</td>
                            <td>{{$eje->nombre}}</td>
                            <td>{{$eje->asignatura_id}}</td>
                            <td>{{$eje->nivel_id}}</td>
                            <td>
                                <a href="{{ route('ejes.edit',$eje->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('ejes.destroy', $eje->id)}}" method="post">
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