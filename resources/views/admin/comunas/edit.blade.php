@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Comuna</h1>
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
                <form method="post" action="{{ route('comunas.update', $comuna->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">    
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value={{ $comuna->nombre }} />
                    </div>
                    <div class="form-group">    
                        <label for="region_id">Region:</label>
                        <input type="text" class="form-control" name="region_id" value={{ $comuna->region_id }} />
                    </div>                                                      
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection