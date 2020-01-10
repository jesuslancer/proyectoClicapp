@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Establecimientos</h1> 
            <a style="margin: 19px;" href="{{ route('establecimientos.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>RBD</td>
                        <td>DV</td>
                        <td>Nivel</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($establecimientos as $establecimiento)
                        <tr>
                            <td>{{$establecimiento->id}}</td>
                            <td>{{$establecimiento->nombre}}</td>
                            <td>{{$establecimiento->rbd}}</td>
                            <td>{{$establecimiento->dv}}</td>
                            <td>{{$establecimiento->nivel_id}}</td>
                            <td>
                                <a href="{{ route('establecimientos.edit',$establecimiento->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('establecimientos.destroy', $establecimiento->id)}}" method="post">
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