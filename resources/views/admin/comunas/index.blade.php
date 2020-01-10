@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Comunas</h1> 
            <a style="margin: 19px;" href="{{ route('comunas.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Region</td>
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comunas as $comuna)
                        <tr>
                            <td>{{$comuna->id}}</td>
                            <td>{{$comuna->nombre}}</td>
                            <td>{{$comuna->region_id}}</td>
                            <td>
                                <a href="{{ route('comunas.edit',$comuna->id)}}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('comunas.destroy', $comuna->id)}}" method="post">
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