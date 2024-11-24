@extends('layouts.plantilla')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center botonMenuPrincipal">
        <div class="col-8 p-5">
            <label class="centrarTexto">INGRESAR PACIENTE NUEVO </label>
        </div>
        <div class="col-4">
            <i class="bi bi-person-fill-add colorAzul" style="font-size:8rem;"></i>
        </div>
    </div>
    <div class="row justify-content-center botonMenuPrincipal mt-5">
        <div class="col-8 p-5">
            <label class="centrarTexto">EN HOSPITAL </label>
        </div>
        <div class="col-4">
            <i class="bi bi-hospital colorAzul" style="font-size:8rem;"></i>
        </div>
    </div>
    <div class="row justify-content-center botonMenuPrincipal mt-5">
        <div class="col-8 p-5">
            <label class="centrarTexto">REPORTES </label>
        </div>
        <div class="col-4">
            <i class="bi bi-card-checklist colorAzul" style="font-size:8rem;"></i>
        </div>
    </div>
    
</div>
@endsection
