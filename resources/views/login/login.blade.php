@extends('base')

@section('page-title', '¡Bienvenido!')

@push('css-lib')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
        <div class="col-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="text-center">
                                <h3><b>¡Bienvenido!</b></h3>
                            </div>

                            <form class="form-signin form-signin-accion" id="form-signin-accion" method="POST"
                                action="{{ route('web.login') }}">

                                @csrf

                                <div class="form-group">
                                    <label for="loginPin">PIN (4 dígitos)*</label>
                                    <input type="password" id="loginPin" name="login_pin" class="form-control"
                                        autocomplete="off" placeholder="PIN" maxlength="4" required autofocus>
                                </div>

                                <div class="form-group" style="text-align: justify;">
                                    * Si aun no tienes PIN puedes ingresar los 4 dígitos que quieras, para la siguiente vez
                                    tendrás que volver a ingresar los mismos 4 dígitos.
                                </div>

                                <div class="form-group">
                                    <label for="username">Usuario</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Usuario" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        autocomplete="off" placeholder="Contraseña" required>
                                </div>

                                <div class="form-group mt-2">
                                    <button class="btn btn-primary btn-block submit" type="submit">
                                        Iniciar sesión
                                    </button>
                                </div>

                                @foreach ($errors->all() as $error)
                                    <div class="form-group mt-2">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endforeach
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
