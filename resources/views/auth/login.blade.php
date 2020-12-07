@extends('layouts.form')
@section('title','Acceder')
@section('subtitle','Ingrese tus credenciales')


@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @if ($errors->any())
                            <div class="text-center text-muted mb-4">
                                <small>Falla la autentificacion</small>
                            </div>
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first()}}
                            </div>
                        @endif


                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                           type="email"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control  @error('password') is-invalid @enderror"
                                           placeholder="Password" type="password" name="password" required
                                           autocomplete="current-password">

                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input " name="remember"
                                       type="checkbox"
                                       id="remember" >
                                <label class="custom-control-label" for="remenber">
                                    <span class="text-muted">{{ __('Remember Me') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('password.request') }}" class="text-light"><small>Olvidastes tus
                                credenciales</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-light"><small>Crear nuevo usuario</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
