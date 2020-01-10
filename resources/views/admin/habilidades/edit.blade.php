@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Habilidad</h1>
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
                <form method="post" action="{{ route('habilidades.update', $habilidad->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" name="codigo" value={{ $habilidad->codigo }} />
                    </div>   
                    <div class="form-group">    
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value={{ $habilidad->nombre }} />
                    </div>
                    <div class="form-group">    
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" value={{ $habilidad->descripcion }} />
                    </div>   
                    <div class="form-group">    
                        <label for="asignatura_id">Asignatura:</label>
                        <input type="text" class="form-control" name="asignatura_id" value={{ $habilidad->asignatura_id }} />
                    </div>
                    <div class="form-group">    
                        <label for="nivel_id">Nivel:</label>
                        <input type="text" class="form-control" name="nivel_id" value={{ $habilidad->nivel_id }} />
                    </div>                                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection