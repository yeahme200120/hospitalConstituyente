@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/actualizarPaciente" method="POST" class="mt-3 container">
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
                                {{-- Campos importantes de ids --}}
                                <input class="form-control" type="hidden" name="id_hospital" id="id_hospital" value="{{$id_hospital}}">
                                <input class="form-control" type="hidden" id="Id" name="Id" value="{{$paciente->id}}">
                                <!-- Nombre completo -->
                                <div class="form-group">
                                    <label for="nombre">Nombre completo:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        value="{{ $paciente->nombre }}">
                                </div>
                                <div class="row p-2">
                                    <div class="col-12 col-md-8">
                                        <div class="row justify-content-md-center">
                                            <div class="col-12 col-md-6">
                                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                            </div>
                                            @php
                                                $mesActual = date('n');
                                                $diaActual = date('j');
                                                $añoActual = date('Y');
                                            @endphp
                                            <div class="d-flex">
                                                <select name="fecha_nac_dia" id="fecha_nac_dia" class="form-control col-2"
                                                    style="width: 25%;">
                                                    <option value="" disabled {{ old('fecha_nac_dia') ? '' : 'selected' }}>Selecciona una opción...</option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" {{ $i == ($paciente->fecha_nac_dia ) ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                    @endfor
                                                </select>
                                                <select name="fecha_nac_mes" id="fecha_nac_mes" class="form-control" value="old($paciente->fecha_nac_mes)">
                                                    <option value="0" @if ($paciente->fecha_nac_mes == 0) selected @endif
                                                        disabled>Sin Mes registrado</option>
                                                    <option value="1"
                                                        @if ($paciente->fecha_nac_mes == 1) selected @endif>ENERO</option>
                                                    <option value="2"
                                                        @if ($paciente->fecha_nac_mes == 2) selected @endif>FEBRERO</option>
                                                    <option value="3"
                                                        @if ($paciente->fecha_nac_mes == 3) selected @endif>MARZO</option>
                                                    <option value="4"
                                                        @if ($paciente->fecha_nac_mes == 4) selected @endif>ABRIL</option>
                                                    <option value="5"
                                                        @if ($paciente->fecha_nac_mes == 5) selected @endif>MAYO</option>
                                                    <option value="6"
                                                        @if ($paciente->fecha_nac_mes == 6) selected @endif>JUNIO</option>
                                                    <option value="7"
                                                        @if ($paciente->fecha_nac_mes == 7) selected @endif>JULIO</option>
                                                    <option value="8"
                                                        @if ($paciente->fecha_nac_mes == 8) selected @endif>AGOSTO</option>
                                                    <option value="9"
                                                        @if ($paciente->fecha_nac_mes == 9) selected @endif>SEPTIEMBRE
                                                    </option>
                                                    <option value="10"
                                                        @if ($paciente->fecha_nac_mes == 10) selected @endif>OCTUBRE</option>
                                                    <option value="11"
                                                        @if ($paciente->fecha_nac_mes == 11) selected @endif>NOVIEMBRE
                                                    </option>
                                                    <option value="12"
                                                        @if ($paciente->fecha_nac_mes == 12) selected @endif>DICIEMBRE
                                                    </op-+
                                                    +
                                                    +tion>
                                                </select>
                                                <select name="fecha_nac_año" id="fecha_nac_año" class="form-control"
                                                    style="width: 35%;" onchange="calculaEdad()">
                                                    @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ $i == $paciente->fecha_nac_año ? 'selected' : '' }}>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('fecha_nac_año')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-3 mt-1">
                                                <label for="edad">Edad:</label>
                                            </div>
                                            <div class="col-9 mt-1">
                                                <input type="number" id="edad" name="edad" class="form-control"
                                                    value="{{ $paciente->edad }}" readonly min="1">

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
                                                <select name="genero" id="genero" class="form-control">
                                                    <option value="" @if($paciente->genero != "Hombre" && $paciente->genero != "Mujer" || $paciente->genero == "" ) selected @endif disabled>Sin genero registrado</option>
                                                    <option value="Hombre" @if($paciente->genero == "Hombre") selected @endif>Hombre</option>
                                                    <option value="Mujer" @if($paciente->genero == "Mujer") selected @endif>Mujer</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <div class="row">
                                            <div class="col">
                                                <label for="enfermedades_cronicas">Enfermedades crónicas:</label>
                                            </div>
                                            <div class="col">
                                                <label for="">
                                                    <ul>
                                                        @foreach ($enfermedades as $en)
                                                            <li>
                                                                {{ $en->enfermedad }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </label>
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
                                                <input type="number" name="telefono" id="telefono"
                                                    class="form-control" value="{{ $paciente->telefono }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="alergias">Alergias:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <input type="text" name="alergias" id="alergias"
                                                  -+-+  class="form-control" value="{{ $paciente->alergias }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row continer justify-content-md-center mt-3 ">
                    <div class="col-12 col-md-3">
                        <button class="btn btn-primary">Actualizar Datos del paciente</button>
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
