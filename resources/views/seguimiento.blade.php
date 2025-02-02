@extends('layouts.plantilla')

@section('content')
<div class="row text-center">
    <h3>SEGUIMIENTO FARMACOTERAPÉUTICO</h3>
</div>
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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Paciente:</label>
                                            <select class="form-control select2" name="pacientesSelect" id="pacientesSelect" onchange="llenarDatos()">
                                                <option value="" disabled selected>Nuevo registró</option>
                                                @foreach ($pacientes as $paciente)
                                                    <option value="{{$paciente}}">{{$paciente->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Nombre completo -->
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre completo:</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre')}}">
                                            @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                                <label for="id">  Folio:</label>
                                                <input type="hidden" id="id" name="id" class="form-control"
                                                    readonly value="{{$id}}">
                                                <input type="text" id="id_paciente" name="id_paciente" class="form-control"
                                                    readonly value="{{$id_pac}}">
                                                @error('id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $mesActual = date("n");
                                    $diaActual = date("j");
                                    $añoActual = date("Y");
                                @endphp
                                <div class="row p-2">
                                    <div class="col-12 col-md-8">
                                        <div class="row justify-content-md-center">
                                            <div class="col-12 col-md-3">
                                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                            </div>
                                            <div class="d-flex">
                                                <select name="fecha_nac_dia" id="fecha_nac_dia" class="form-control col-2"
                                                    style="width: 25%;">
                                                    <option value="" disabled {{ old('fecha_nac_dia') ? '' : 'selected' }}>Selecciona una opción...</option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" {{ $i == ($diaActual ) ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                    @endfor
                                                </select>
                                                @error('fecha_nac_dia')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                
                                                <select name="fecha_nac_mes" id="fecha_nac_mes" class="form-control mx-2" style="width: 40%;">
                                                    <option value="" disabled {{ old('fecha_nac_mes') ? '' : 'selected' }}>Selecciona una opción...</option>
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                        <option value="{{ $index + 1 }}" 
                                                                    {{ ($index + 1) == $mesActual ? 'selected' : '' }}>
                                                            {{ $mes }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fecha_nac_mes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <select name="fecha_nac_año" id="fecha_nac_año" class="form-control"
                                                    style="width: 35%;" onchange="calculaEdad()">
                                                    @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                    <option value="{{ $i }}" {{ $i == $añoActual ? 'selected' : '' }}>
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
                                                <input type="text" id="edad" name="edad" class="form-control"
                                                    readonly value="{{ old('edad')}}">
                                                @error('edad')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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
                                                <input type="radio" name="genero" value="Hombre" id="hombre" 
                                                {{ old('genero') == 'Hombre' ? 'checked' : '' }}>
                                                <label for="hombre">Hombre</label>
                                                <input type="radio" name="genero" value="Mujer" id="mujer"
                                                    class="ml-2" {{ old('genero') == 'Mujer' ? 'checked' : '' }}>
                                                <label for="mujer">Mujer</label>
                                                @error('genero')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <div class="row">
                                            <div class="col">
                                                <label for="enfermedades_cronicas">Enfermedades crónicas:</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select select2" id="enfermedades_cronicas"
                                                    name="enfermedades_cronicas[]" multiple="multiple">
                                                    <option value="" disabled {{ old('enfermedades_cronicas') ? '' : 'selected' }}>Selecciona una opción...</option>
                                                    @foreach ($enfermedades as $enfermedad)
                                                        <option value="{{ $enfermedad->id }}">
                                                            {{ $enfermedad->enfermedad }}</option>
                                                    @endforeach
                                                </select>
                                                @error('enfermedades_cronicas')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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
                                                <input type="number" name="telefono" id="telefono" class="form-control"
                                                     value="{{old('telefono')}}" min="1111111111">
                                                @error('telefono')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="alergias">Alergias:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <input name="alergias" id="alergias" class="form-control" value="{{old('alergias')}}">
                                                @error('alergias')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Ingresos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fecha de Ingreso -->
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                    <div class="d-flex">
                                        <select name="dia" id="dia" class="form-control" style="width: 25%;">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" value="{{ $i }}" {{ $i == ($diaActual ) ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('dia')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="mes" id="mes" class="form-control mx-2"
                                            style="width: 40%;">
                                            @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                <option value="{{ $index + 1 }}"  {{ ($index + 1) == $mesActual ? 'selected' : '' }}>{{ $mes }}</option>
                                            @endforeach
                                        </select>
                                        @error('mes')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="anio" id="anio" class="form-control" style="width: 35%;">
                                            @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                <option value="{{ $i }}"  {{ $i == $añoActual ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('anio')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hora de Ingreso -->
                                <div class="form-group">
                                    <label for="hora_ingreso">Hora de Ingreso:</label>
                                    <input type="time" name="hora_ingreso" id="hora_ingreso" class="form-control"
                                        value="{{ old('hora_ingreso', date('H:i')) }}">
                                    @error('hora_ingreso')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Diagnóstico de Ingreso -->
                                        <div class="form-group">
                                            <label for="diagnostico_ingreso">Diagnóstico de Ingreso:</label>
                                            <input name="diagnostico_ingreso" id="diagnostico_ingreso" class="form-control" rows="3" value="{{old('diagnostico_ingreso')}}">
                                            @error('diagnostico_ingreso')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <!-- Servicio -->
                                            <div class="form-group">
                                                <label for="servicio">Servicio:</label>
                                                <select class="form-select" id="servicio" name="servicio">
                                                    <option value="" disabled {{ old('servicio') ? '' : 'selected' }}>Selecciona un Servicio...</option>
                                                    @foreach ($servicios as $servicio)
                                                        <option value="{{ $servicio->id }}">{{ $servicio->servicio }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('servicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <!-- Cama -->
                                            <div class="form-group">
                                                <label for="cama">Cama:</label>
                                                <select class="form-select" id="cama" name="cama">
                                                    <option value="" disabled {{ old('cama') ? '' : 'selected' }}>Selecciona una cama...</option>
                                                    @foreach ($camas as $cama)
                                                        <option value="{{ $cama->id }}" {{ old('cama') == $cama->id ? 'selected' : '' }}>
                                                            {{ $cama->cama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('cama')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Signos Vitales
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Frecuencia Cardíaca -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                                        <input type="text" name="frecuencia_cardiaca" id="frecuencia_cardiaca"
                                            class="form-control" placeholder="Latidos por minuto" value="{{old('frecuencia_cardiaca')}}">
                                        @error('frecuencia_cardiaca')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tensión Arterial -->
                                    <div class="col-md-6 form-group">
                                        <label for="tension_arterial">Tensión Arterial:</label>
                                        <input type="text" name="tension_arterial" id="tension_arterial"
                                            class="form-control" placeholder="Ejemplo: 120/80" value="{{old('tension_arterial')}}">
                                        @error('tension_arterial')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Temperatura -->
                                    <div class="col-md-6 form-group">
                                        <label for="temperatura">Temperatura:</label>
                                        <input type="text" name="temperatura" id="temperatura" class="form-control"
                                            placeholder="En grados Celsius" value="{{old('temperatura')}}">
                                        @error('temperatura')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Frecuencia Respiratoria -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                                        <input type="text" name="frecuencia_respiratoria" id="frecuencia_respiratoria"
                                            class="form-control" placeholder="Respiraciones por minuto" value="{{old('frecuencia_respiratoria')}}">
                                        @error('frecuencia_respiratoria')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Oxigenación -->
                                    <div class="col-md-6 form-group">
                                        <label for="oxigenacion">Oxigenación:</label>
                                        <input type="text" name="oxigenacion" id="oxigenacion" class="form-control"
                                            placeholder="Porcentaje de oxígeno" value="{{old('oxigenacion')}}">
                                        @error('oxigenacion')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Peso -->
                                    <div class="col-md-6 form-group">
                                        <label for="peso">Peso:</label>
                                        <input type="text" name="peso" id="peso" class="form-control"
                                            placeholder="En kilogramos" value="{{old('peso')}}">
                                        @error('peso')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Talla -->
                                    <div class="col-md-6 form-group">
                                        <label for="talla">Talla:</label>
                                        <input type="text" name="talla" id="talla" class="form-control"
                                            placeholder="En centímetros" value="{{old('talla')}}">
                                        @error('talla')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-2">
                        <button type="submit" class="btn btn-principal" style="font-style: oblique;">Siguiente</button>
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
            $('.select2').select2();    
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
            $("#dia").val(fecha.getDate())
        }
        function llenarDatos() {
        const selectedValue = $('#pacientesSelect').val();  
        let paciente = JSON.parse(selectedValue);
        
        let nombre = $("#nombre").val(paciente.nombre);
        let fecha_nac_dia = $("#fecha_nac_dia").val(paciente.fecha_nac_dia);
        let fecha_nac_mes = $("#fecha_nac_mes").val(paciente.fecha_nac_mes);
        let fecha_nac_año = $("#fecha_nac_año").val(paciente.fecha_nac_año);
        let edad = $("#edad").val(paciente.edad);    
        let genero = $("#genero").val(paciente.genero);
        let enfermedades_cronicas = $("#enfermedades_cronicas").val(paciente.enfermedades_cronicas);
        let telefono = $("#telefono").val(paciente.telefono);
        let alergias = $("#alergias").val(paciente.alergias);
        let id = $("#id").val(paciente.id);
        let id_paciente = $("#id_paciente").val(paciente.id_paciente);
    }
    </script>
@endsection
