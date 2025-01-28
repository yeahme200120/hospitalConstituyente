@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row m-2 p-2 btn-secundario justify-content-center">
            <div class="col-5 col-md-3 text-center">
                REPORTE DE SERVICIO
            </div>
        </div>  
        <div class="table table-responsive mt-5">
            {{-- <div class="row mt-5 mb-5 justify-content-end">
                <div class="col-6 col-md-2">
                    <button class="btn text-white" style="background-color: #162f46; border-radius: 2rem;" onclick="filtrar()">Buscar por nombre</button>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" name="filtro" id="filtro">
                </div>
            </div> --}}
            <table class="table" id="tablaReporte">
                <thead>
                    <tr>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Id</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Nombre</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Fecha Ingreso</th>
                    </tr>
                </thead>
                <tbody class="p-3" id="cuerpoReporteServicio">
                    @foreach ($hospitalizados as $paciente)
                        <tr>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ $paciente->id }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1"><a onclick="filtrar({{$paciente->pacienteSQL}})"
                                    class="text-white">{{ $paciente->paciente }} </a></td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ date($paciente->fecha) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$hospitalizados->links()}} --}}
            <div class="d-flex justify-content-center">
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
            $('#tablaReporte').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
               
            });
        });

        function calculaEdad() {
            let año = $("#fecha_nac_año").val()
            let fecha = new Date()
            let edad = (fecha.getFullYear() - año);
            $("#edad").val(edad);
        }
        function filtrar(valor){
            let filtro = valor;
            console.log("Valor: ", filtro);
            window.location.href = `/filtro/${filtro}`;
        }
    </script>
@endsection
