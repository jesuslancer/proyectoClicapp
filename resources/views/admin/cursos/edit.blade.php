@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Curso</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                @endif
                <form method="post" action="{{ route('cursos.update', $curso->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="letra">Letra:</label>
                        <input type="text" class="form-control" name="letra" value={{ $curso->letra }} />
                    </div>   
                    <div class="form-group">    
                        <label for="establecimiento_id">Establecimiento:</label>
                        <input type="text" class="form-control" name="establecimiento_id" value={{ $curso->establecimiento_id }} />
                    </div>
                    <div class="form-group">    
                        <label for="nivel_id">Nivel:</label>
                        <input type="text" class="form-control" name="nivel_id" value={{ $curso->nivel_id }} />
                    </div>                                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection