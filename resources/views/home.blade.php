@extends('layouts.plantilla')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center botonMenuPrincipal">
            <a class="col-8 p-5 text-white" href="{{ route('seguimiento') }}">
                <label class="centrarTexto">INGRESAR PACIENTE NUEVO </label>
            </a>
            <div class="col-4">
                <i class="bi bi-person-fill-add colorAzul" style="font-size:8rem;"></i>
            </div>
        </div>
        <a class="row justify-content-center botonMenuPrincipal mt-5" href="{{ route('enHospital') }}">
            <div class="col-8 p-5">
                <label class="centrarTexto">EN HOSPITAL </label>
            </div>
            <div class="col-4">
                <i class="bi bi-hospital colorAzul" style="font-size:8rem;"></i>
            </div>
        </a>
        <div class="row justify-content-center botonMenuPrincipal mt-5">
            <a class="row justify-content-center botonMenuPrincipal mt-5" href="{{ route('exportar') }}">
                <div class="col-8 p-5">
                    <label class="centrarTexto">REPORTES </label>
                </div>
                <div class="col-4">
                    <i class="bi bi-card-checklist colorAzul" style="font-size:8rem;"></i>
                </div>
            </a>
        </div>

    </div>
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
@endsection
