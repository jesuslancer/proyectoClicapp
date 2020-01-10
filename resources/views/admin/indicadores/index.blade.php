@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Indicadores</h1> 
            <a style="margin: 19px;" href="{{ route('indicadores.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Descripcion</td>
                        <td>Eje</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($indicadores as $indicador)
                        <tr>
                            <td>{{$indicador->id}}</td>
                            <td>{{$indicador->descripcion}}</td>
                            <td>{{$indicador->eje_id}}</td>
                            <td>
                                <a href="{{ route('indicadores.edit',$indicador->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('indicadores.destroy', $indicador->id)}}" method="post">
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