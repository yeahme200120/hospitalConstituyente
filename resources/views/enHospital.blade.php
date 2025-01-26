@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row m-2 p-2 btn-secundario justify-content-center">
            <div class="col-5 col-md-3 text-center">
                EN HOSPITAL
            </div>
        </div>  
        <div class="table table-responsive">
            <table class="table" id="tablaHospital">
                <thead>
                    <tr>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Id</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Nombre</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Fecha Ingreso</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Hora Ingreso</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Servicio</th>
                        <th scope="col" style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Cama</th>
                        <th style="background-color: #28a58d; color: white; border-radius: 2rem;"
                            class="text-center m-1 p-1">Editar</th>
                    </tr>
                </thead>
                <tbody class="p-3">
                    @foreach ($hospitalizados as $paciente)
                        <tr>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ $paciente->id }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1"><a href="/cambios/{{ $paciente->id_paciente }}/{{$paciente->id}}"
                                    class="text-white">{{ $paciente->paciente }} </a></td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ date($paciente->fecha) }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ $paciente->hora }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ $paciente->servicio }}</td>
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1">{{ $paciente->cama }}</td>  
                            <td scope="row" style="background-color: #162f46; color: white; border-radius: 2rem;"
                                class="text-center m-1 p-1"><a class="text-white" href="/datosPaciente/{{ $paciente->id_paciente}}/{{$paciente->id}}"><i
                                        class="bi bi-pencil-square"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{-- {{ $hospitalizados->links() }} --}}
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
            $('#tablaHospital').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-print "></i>',
                    title: 'En Hospital',
                    className: 'btn btn-danger',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                    customize: function(doc) {
                        // Definir márgenes personalizados
                        doc.pageMargins = [20, 20, 20, 20]; // Izquierda, Arriba, Derecha, Abajo

                        // Ajustar tabla al ancho completo
                        var table = doc.content[1].table;
                        var columnCount = table.body[0].length; // Número de columnas
                        table.widths = Array(columnCount).fill(
                        '*'); // Todas las columnas se ajustan proporcionalmente

                        // Opcional: Cambiar tamaño de fuente
                        doc.defaultStyle.fontSize = 10;

                        // Ajustar contenido para caber en la página
                        doc.content[1].layout = {
                            fillColor: function(rowIndex, node, columnIndex) {
                                return rowIndex % 2 === 0 ? '#f3f3f3' :
                                null; // Alterna colores de fondo para filas
                            }
                        };

                        // Configurar estilos de cabecera
                        doc.styles.tableHeader = {
                            fillColor: '#28a58d', // Fondo verde
                            color: 'white', // Texto blanco
                            alignment: 'center',
                            fontSize: 12,
                            bold: true
                        };
                    }
                }]
            });
        });

        function calculaEdad() {
            let año = $("#fecha_nac_año").val()
            let fecha = new Date()
            let edad = (fecha.getFullYear() - año);
            $("#edad").val(edad);

        }
    </script>
@endsection
