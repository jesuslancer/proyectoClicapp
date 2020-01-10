@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Profesor - Asignatura</h1>
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
                <form method="post" action="{{ route('profesor-asignatura.update', $profesor_asignatura->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="profesor_id">Profesor:</label>
                        <input type="text" class="form-control" name="profesor_id" value={{ $profesor_asignatura->profesor_id }} />
                    </div>
                    <div class="form-group">
                        <label for="asignatura_id">Asignatura</label>
                        <input type="text" class="form-control" name="asignatura_id" value={{ $profesor_asignatura->asignatura_id }} />
                    </div>
                    <div class="form-group">
                        <label for="establecimiento_id">Establecimiento:</label>
                        <input type="text" class="form-control" name="establecimiento_id" value={{ $profesor_asignatura->establecimiento_id }} />
                    </div>
                    <div class="form-group">
                        <label for="nivel_id">Nivel:</label>
                        <input type="text" class="form-control" name="nivel_id" value={{ $profesor_asignatura->nivel_id }} />
                    </div>
                    <div class="form-group">
                        <label for="curso_id">Curso:</label>
                        <input type="text" class="form-control" name="curso_id" value={{ $profesor_asignatura->curso_id }} />
                    </div>
                    <div class="form-group">
                        <label for="periodo_id">Periodo:</label>
                        <input type="text" class="form-control" name="periodo_id" value={{ $profesor_asignatura->periodo_id }} />
                    </div>                      
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection