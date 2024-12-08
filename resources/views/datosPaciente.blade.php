@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/registrarSeguimiento" method="POST" class="mt-3 container">
                @csrf
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                        <button class="accordion-button btn-secundario" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Información Personal
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nombre completo -->
                                <div class="form-group">
                                    <label for="nombre">Nombre completo:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->nombre}}">
                                </div>
                                <div class="row p-2">
                                    <div class="col-12 col-md-8">
                                        <div class="row justify-content-md-center">
                                            <div class="col-12 col-md-6">
                                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                            </div>
                                            <div class="d-flex">
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->fecha_nac_dia}}">
                                                @php
                                                    $meses=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] ;  
                                                @endphp
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{ $meses[ $paciente->fecha_nac_dia + 1] }}">
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->fecha_nac_año}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-3 mt-1">
                                                <label for="edad">Edad:</label>
                                            </div>
                                            <div class="col-9 mt-1">
                                                <input type="text" id="edad" name="edad" class="form-control" value="{{$paciente->edad}}" readonly>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-1">
                                    <div class="col-12 col-md-6">
                                        <!-- Género -->
                                        <div class="row">
                                            <div class="col">
                                                <label>Género:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->genero}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <div class="row">
                                            <div class="col">
                                                <label for="enfermedades_cronicas">Enfermedades crónicas:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{$enfermedades->enfermedad}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="telefono">Número telefónico:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->telefono}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="alergias">Alergias:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <input type="text" name="nombre" id="nombre" class="form-control" readonly value="{{$paciente->alergias}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
@endsection
