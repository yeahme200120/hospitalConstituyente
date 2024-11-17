@extends('layouts.app')
<link rel="stylesheet" href="../../css/estilos_globales.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 ">
            <div class="card" style="background-color: #28a58d">

                <div class="card-body fondo-principal">
                    <div class="row pt-2">
                        <div class="col-6 text-center">
                            <img src="{{ asset('img/LogoLetra.png') }}" alt="Imagen no localizada" width="50%">
                        </div>
                        <div class="col-6 text-center">
                            <img src="{{ asset('img/LogoHospital.png') }}" alt="Imagen no localizada" width="50%">
                        </div>
                    </div>
                    <div class="row mt-1"></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center text-center">
                            <h2 for="email" class="col-4 col-form-label ">{{ __('Usuario') }}</h2>

                            <div class="col-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 text-center justify-content-center">
                            <h1z for="password" class="col-md-4 col-form-label">{{ __('Contraseña') }}</h1z>

                            <div class="col-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                                <button type="submit" class="btn-secundario col-10 col-md-3 m-2">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
