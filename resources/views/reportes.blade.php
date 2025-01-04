@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <form action="exportToExcelFiltrado" method="POST">
            @csrf
        <div class="row m-2 p-2 btn-secundario justify-content-center">
            <div class="col-5 col-md-3 text-center">
                Exportar reportes
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="">Fecha Inicio</label>
                <input type="date" name="fecha" class="form-control">
            </div>
            <div class="col-12 col-md-6">
                <label for="">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
            </div>
        </div>
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><a href="/exportDinamica/PACIENTE-INGRESO" class="text-center text-white">PACIENTE-INGRESO</a></div>
            <div class="col-12 col-md-2 btn-secundario p-2 m-2 text-center"><button type="submit" style="background-color: transparent; border:none;" class="text-center text-white">REPORTE SERVICIO</button></div>    
        </div>
    </form>
    </div>
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    
        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
         function enviarFiltros(){
            let fecha = $("#fecha").val();
            let paciente = $('#paciente').val();
            console.log(fecha, paciente);
        }
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
