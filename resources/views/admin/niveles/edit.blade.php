@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Nivel</h1>
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
                <form method="post" action="{{ route('niveles.update', $nivel->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value={{ $nivel->nombre }} />
                    </div>   
                    <div class="form-group">    
                        <label for="asignatura_id">Asignatura:</label>
                        <input type="text" class="form-control" name="asignatura_id" value={{ $nivel->asignatura_id }} />
                    </div>                                
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection