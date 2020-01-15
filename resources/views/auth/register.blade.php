@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">{{ __('Roles*') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="rol" required autofocus >
                                    <option value="1">Administrador</option>
                                    <option value="2">UTP</option>
                                    <option value="3">Profesor</option>
                                    <option value="4">Alumno</option>
                                    <option value="5">Sostenedor</option>
                                    option
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<div class="form-group row">
                            <label for="apellido1" class="col-md-4 col-form-label text-md-right">{{ __('Primer Apellido*') }}</label>

                            <div class="col-md-6">
                                <input id="apellido1" type="text" class="form-control @error('Apellido') is-invalid @enderror" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required  autofocus>

                                @error('Apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellido2" class="col-md-4 col-form-label text-md-right">{{ __('Segundo Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="apellido2" type="text" class="form-control @error('Apellido') is-invalid @enderror" name="apellido_materno" value="{{ old('apellido_materno') }}"  autofocus>

                                @error('Apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Nacimiento*') }}</label>

                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control @error('Fecha Nacimiento') is-invalid @enderror" name="fecha_nac" value="{{ old('fecha_nac') }}" required  autofocus>

                                @error('fecha_nac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Género*') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="genero" required autofocus >
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    option
                                </select>
                                @error('genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono*') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('Telefono') is-invalid @enderror" name="telefono_contacto_1" value="{{ old('telefono_contacto_1') }}" required  autofocus>

                                @error('telefono_contacto_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono2" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono2') }}</label>

                            <div class="col-md-6">
                                <input id="telefono2" type="text" class="form-control @error('Telefono2') is-invalid @enderror" name="telefono_contacto_2" value="{{ old('telefono_contacto_2') }}"  autofocus>

                                @error('telefono_contacto_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <textarea name="direccion" class="form-control @error('direccion') is-invalid @enderror" autofocus></textarea>
                                @error('telefono_contacto_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme Contraseña*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="d-flex justify-content-between">
                                
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-danger">
                                <a class="button" href="{{ url('home') }}"  style="color:#ffffff; text-decoration:none; ">Cancelar</a>
                                </button>
                            </div>
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
