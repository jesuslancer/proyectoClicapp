@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Establecimiento</h1>
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
                <form method="post" action="{{ route('establecimientos.update', $establecimiento->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value={{ $establecimiento->nombre }} />
                    </div>   
                    <div class="form-group">    
                        <label for="rbd">RBD:</label>
                        <input type="text" class="form-control" name="rbd" value={{ $establecimiento->rbd }} />
                    </div>
                    <div class="form-group">    
                        <label for="dv">DV:</label>
                        <input type="text" class="form-control" name="dv" value={{ $establecimiento->dv }} />
                    </div>
                    <div class="form-group">    
                        <label for="nivel_id">Nivel:</label>
                        <input type="text" class="form-control" name="nivel_id" value={{ $establecimiento->nivel_id }} />
                    </div>                                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection