@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row m-2 p-2 btn-secundario justify-content-center">
            <div class="col-5 col-md-3 text-center">
                EN HOSPITAL
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Id</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Nombre</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Fecha Ingreso</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Hora Ingreso</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Servicio</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Cama</th>
                        <th style="background-color: #28a58d; color: white; border-radius: 2rem;" class="text-center m-1 p-1">Editar</th>
                    </tr>
                </thead>
                <tbody class="p-3">
                    @foreach ($hospitalizados as $paciente)
                        <tr>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1">{{ $paciente->id }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1"><a href="/datosPaciente/{{$paciente->id}}" class="text-white">{{ $paciente->nombre }} </a></td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1">{{ $paciente->diaInicio }}/{{ $paciente->mesInicio }}/{{ $paciente->anioInicio }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1">{{ $paciente->horario }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1">{{ $paciente->servicio }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1">{{ $paciente->cama }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;" class="text-center m-1 p-1"><a class="text-white" href="/cambios/{{$paciente->id}}"><i class="bi bi-pencil-square"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $hospitalizados->links() }}
            </div>
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
