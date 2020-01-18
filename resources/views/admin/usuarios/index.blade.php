@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Usuarios</h1> 
            <a style="margin: 19px;" href="{{ route('usuarios.create')}}" class="btn btn-primary">Agregar</a>   
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Usuario</td>
                        <td>Email</td>
                        {{-- <td>Nombres</td>
                        <td>Apellido</td> --}}
                        <td colspan = 2>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->id}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>
                           {{--  <td>{{$usuario->descripcion}}</td>
                            <td>{{$usuario->asignatura_id}}</td>
                            <td>{{$usuario->nivel_id}}</td>--}}
                            {{-- <td> 
                                <a href="{{ route('usuarios.edit',$usuario->id)}}" class="btn btn-primary">Editar</a>
                            </td> --}}
                            <td>
                                <form action="{{ route('usuarios.destroy', $usuario->id)}}" method="post">
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