@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-sm-8 offset-sm-2">
      <h1 class="display-3">Agregar Region</h1>
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
        <form method="post" action="{{ route('regiones.store') }}">
          @csrf
          <div class="form-group">    
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" />
                    </div>
                    <div class="form-group">    
                        <label for="subtitulo">Subtitulo:</label>
                        <input type="text" class="form-control" name="subtitulo" />
                    </div>
                    <div class="form-group">    
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" />
                    </div> 
                    <div class="form-group">    
                        <label for="num_horas">Num / Horas:</label>
                        <input type="text" class="form-control" name="num_horas" />
                    </div>                     
                    <div class="form-group">    
                        <label for="num_clases">Num / Clases:</label>
                        <input type="text" class="form-control" name="num_clases" />
                    </div>
                    <div class="form-group">    
                        <label for="asignatura_id">Asignatura:</label>
                        <input type="text" class="form-control" name="asignatura_id" />
                    </div>
                    <div class="form-group">    
                        <label for="nivel_id">Nivel:</label>
                        <input type="text" class="form-control" name="nivel_id" />
                    </div>                          
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
@endsection