@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-sm-8 offset-sm-2">
      <h1 class="display-3">Agregar Indicadores</h1>
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
        <form method="post" action="{{ route('indicadores.store') }}">
          @csrf
            <div class="form-group">    
              <label for="descripcion">Descripcion:</label>
              <input type="text" class="form-control" name="descripcion"/>
            </div>
            <div class="form-group">    
              <label for="eje_id">Eje:</label>
              <input type="text" class="form-control" name="eje_id"/>
            </div>                          
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
@endsection