@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row m-2 p-2 btn-secundario justify-content-center">
            <div class="col-5 col-md-3 text-center">
                Exportar reportes
            </div>
        </div>
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/Pacientes" class="text-center text-white">Pacientes</a></div>
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/Ingresos" class="text-center text-white">Ingresos</a></div>
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/Signos" class="text-center text-white">Signos Vitales</a></div>
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/Tratamientos" class="text-center text-white">Tratamientos </a></div>
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/Hospitalizaciones" class="text-center text-white">Hospitalizaciones </a></div>
            
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
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        });

        function calculaEdad() {
            let año = $("#fecha_nac_año").val()
            let fecha = new Date()
            let edad = (fecha.getFullYear() - año);
            $("#edad").val(edad);

        }
    </script>
    <style>
        td {
            background-color: #28a58d;
            color: white;
            border-radius: 2rem;
        }
    </style>
@endsection
